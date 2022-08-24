<?php

namespace App\Http\Controllers\GDCS\Game;

use App\Enums\GDCS\FriendState;
use App\Enums\Response;
use App\Exceptions\GeometryDashChineseServerException;
use App\Http\Requests\GDCS\Game\AccountInfoFetchRequest;
use App\Http\Requests\GDCS\Game\AccountLoginRequest;
use App\Http\Requests\GDCS\Game\AccountModAccessRequest;
use App\Http\Requests\GDCS\Game\AccountRegisterRequest;
use App\Http\Traits\GameLog;
use App\Models\GDCS\Account;
use App\Models\GDCS\AccountFriend;
use App\Models\GDCS\AccountFriendRequest;
use App\Models\GDCS\AccountMessage;
use App\Models\GDCS\User;
use App\Models\GDCS\UserScore;
use App\Services\Game\ObjectService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    use GameLog;

    public function register(AccountRegisterRequest $request): int
    {
        $data = $request->validated();

        $account = Account::create([
            'name' => $data['userName'],
            'password' => Hash::make($data['password']),
            'email' => $data['email']
        ]);

        $this->logGame(__('gdcn.game.action.account_register_success'));

        $account->sendEmailVerificationNotification();
        return Response::GAME_ACCOUNT_REGISTER_SUCCESS->value;
    }

    /**
     * @throws GeometryDashChineseServerException
     */
    public function fetchInfo(AccountInfoFetchRequest $request): string
    {
        $data = $request->validated();

        $target = Account::query()
            ->find($data['targetAccountID']);

        if (!$target) {
            throw new GeometryDashChineseServerException(__('gdcn.game.error.account_profile_fetch_failed_target_not_found'), response: Response::GAME_ACCOUNT_PROFILE_FETCH_FAILED_NOT_FOUND->value);
        }

        $userInfo = [
            1 => $target->name,
            2 => $target->user->id,
            3 => $target->user->score->stars,
            4 => $target->user->score->demons,
            8 => $target->user->score->creator_points,
            10 => $target->user->score->color1,
            11 => $target->user->score->color2,
            13 => $target->user->score->coins,
            16 => $target->id,
            17 => $target->user->score->user_coins,
            18 => $target->setting->message_state->value,
            19 => $target->setting->friend_request_state->value,
            20 => $target->setting->youtube_channel,
            21 => $target->user->score->acc_icon,
            22 => $target->user->score->acc_ship,
            23 => $target->user->score->acc_ball,
            24 => $target->user->score->acc_bird,
            25 => $target->user->score->acc_dart,
            26 => $target->user->score->acc_robot,
            28 => $target->user->score->acc_glow,
            29 => !empty($target),
            30 => UserScore::query()
                ->where('stars', '<=', $target->user->score->stars)
                ->count(),
            31 => FriendState::NONE->value,
            43 => $target->user->score->acc_spider,
            44 => $target->setting->twitter,
            45 => $target->setting->twitch,
            46 => $target->user->score->diamonds,
            48 => $target->user->score->acc_explosion,
            49 => $target->mod_level->value,
            50 => $target->setting->comment_history_state->value,
        ];

        if (!empty($request->account)) {
            $targetHasBlockedVisitor = $target->blocks()
                ->where('target_account_id', $data['accountID'])
                ->exists();

            if ($targetHasBlockedVisitor) {
                throw new GeometryDashChineseServerException(__('gdcn.game.error.account_profile_fetch_failed_blocked_by_target'), response: Response::GAME_ACCOUNT_PROFILE_FETCH_FAILED_BLOCKED_BY_TARGET->value);
            }

            $targetIsFriend = AccountFriend::findBetween($request->account->id, $target->id)->exists();
            if ($targetIsFriend) {
                $userInfo[31] = FriendState::IS->value;
            }

            $outComingFriendRequestQuery = AccountFriendRequest::query()
                ->where([
                    'account_id' => $data['accountID'],
                    'target_account_id' => $target->id,
                ]);

            if ($outComingFriendRequestQuery->exists()) {
                $friendRequest = $outComingFriendRequestQuery->first();
                $userInfo[31] = FriendState::OUT_COMING->value;
            }

            $inComingFriendRequestQuery = AccountFriendRequest::query()
                ->where([
                    'account_id' => $target->id,
                    'target_account_id' => $data['accountID'],
                ]);

            if ($inComingFriendRequestQuery->exists()) {
                $friendRequest = $inComingFriendRequestQuery->first();
                $userInfo[31] = FriendState::IN_COMING->value;
            }

            if (!empty($friendRequest)) {
                $userInfo[32] = $friendRequest->id;
                $userInfo[35] = $friendRequest->comment;
                $userInfo[37] = $friendRequest->created_at
                    ?->locale('en')
                    ->diffForHumans(syntax: true);
            }

            if ($target->is($request->account)) {
                $userInfo[38] = AccountMessage::query()
                    ->where([
                        'target_account_id' => $data['targetAccountID'],
                        'new' => true,
                    ])->count();

                $userInfo[39] = AccountFriendRequest::query()
                    ->where([
                        'target_account_id' => $data['targetAccountID'],
                        'new' => true,
                    ])->count();

                $userInfo[40] = array_sum([
                    AccountFriend::query()
                        ->where([
                            'account_id' => $data['targetAccountID'],
                            'new' => true,
                        ])->count(),
                    AccountFriend::query()
                        ->where([
                            'friend_account_id' => $data['targetAccountID'],
                            'friend_new' => true,
                        ])->count()
                ]);
            }
        }

        $this->logGame(__('gdcn.game.action.account_profile_fetch_success'));
        return ObjectService::merge($userInfo, ':');
    }

    /**
     * @throws GeometryDashChineseServerException
     */
    public function requestModAccess(AccountModAccessRequest $request): int
    {
        $modLevel = $request->account->mod_level->value;

        if ($modLevel <= 0) {
            throw new GeometryDashChineseServerException(__('gdcn.game.error.account_access_request_failed_not_found'), response: Response::GAME_ACCOUNT_ACCESS_REQUEST_FAILED_NOT_FOUND->value);
        }

        $this->logGame(__('gdcn.game.action.account_access_request_success'));
        return $modLevel;
    }

    /**
     * @throws GeometryDashChineseServerException
     */
    public function login(AccountLoginRequest $request): string|int
    {
        $data = $request->validated();

        $account = $request->account;
        if (!$account->hasVerifiedEmail()) {
            throw new GeometryDashChineseServerException(__('gdcn.game.error.account_login_failed_not_verified_email'), log_context: [
                'account_id' => $account->id
            ], response: Response::GAME_ACCOUNT_LOGIN_FAILED_NEED_VERIFY_EMAIL->value);
        }

        $user = User::query()
            ->firstOrCreate([
                'uuid' => $account->id
            ], [
                'name' => $account->name,
                'udid' => $data['udid']
            ]);

        if ($user->ban->login_ban) {
            throw new GeometryDashChineseServerException(__('gdcn.game.error.account_login_failed_banned'), log_context: [
                'account_id' => $account->id
            ], response: Response::GAME_ACCOUNT_LOGIN_FAILED_BANNED->value);
        }

        $this->logGame(__('gdcn.game.action.account_login_success'), [
            'account_id' => $account->id,
            'user_id' => $user->id
        ]);

        return $account->id . ',' . $user->id;
    }
}