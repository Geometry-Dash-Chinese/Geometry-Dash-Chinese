<?php

namespace App\Enums;

use GeometryDashChinese\GeometryDashAlgorithm;
use function config;

enum Response: int
{
    case SUCCESS = 1;
    case FAILED = -1;
    case SPECIAL_FAILED = -2;

    case ACCOUNT_REGISTER_EMAIL_ALREADY_IN_USE = -3;
    case ACCOUNT_REGISTER_USER_NAME_INVALID = -4;
    case ACCOUNT_REGISTER_PASSWORD_INVALID = -5;
    case ACCOUNT_REGISTER_EMAIL_INVALID = -6;
    case ACCOUNT_REGISTER_PASSWORD_TOO_SHORT = -8;
    case ACCOUNT_REGISTER_USER_NAME_TOO_SHORT = -9;
    case ACCOUNT_LOGIN_FAILED = -11;

    case COMMENT_CREATE_FAILED_BANNED = -10;
    case ACCOUNT_LOGIN_FAILED_BANNED = -12;

    public const INVALID_RESPONSE = Response::FAILED;

    public const REQUEST_VALIDATION_FAILED = Response::FAILED;

    public const REQUEST_AUTHORIZATION_FAILED = Response::FAILED;

    public const ACCOUNT_REGISTER_SUCCESS = Response::SUCCESS;

    public const ACCOUNT_REGISTER_USER_NAME_ALREADY_IN_USE = Response::SPECIAL_FAILED;

    public const ACCOUNT_LOGIN_FAILED_EMAIL_NOT_VERIFIED = Response::FAILED;

    public const ACCOUNT_SETTING_UPDATE_SUCCESS = Response::SUCCESS;

    public const ACCOUNT_COMMENT_DELETE_SUCCESS = Response::SUCCESS;

    public const ACCOUNT_COMMENT_DELETE_FAILED = Response::FAILED;

    public const ACCOUNT_DATA_SAVE_SUCCESS = Response::SUCCESS;

    public const ACCOUNT_DATA_LOAD_FAILED = Response::FAILED;

    public const MOD_ACCESS_NOT_FOUND = Response::FAILED;

    public const USER_FETCH_EMPTY_RESULT = Response::SPECIAL_FAILED;

    public const LEADERBOARD_FETCH_FAILED_TYPE_NOT_FOUND = Response::FAILED;

    public const MESSAGE_UPDATE_FAILED_TARGET_NOT_FOUND = Response::FAILED;

    public const MESSAGE_UPDATE_FAILED_TARGET_BLOCKED = Response::FAILED;

    public const MESSAGE_FETCH_FAILED_EMPTY = Response::SPECIAL_FAILED;

    public const MESSAGE_DOWNLOAD_FAILED_MESSAGE_NOT_FOUND = Response::FAILED;

    public const MESSAGE_DELETE_SUCCESS = Response::SUCCESS;

    public const MESSAGE_DELETE_FAILED_MESSAGE_NOT_FOUND = Response::FAILED;

    public const LEVEL_SEARCH_FAILED_NOT_SUPPORT_TYPE = Response::FAILED;

    public const LEADERBOARD_FETCH_FAILED_ACCOUNT_VALIDATE_FAILED = Response::FAILED;

    public const LEVEL_SEARCH_FAILED_AUTH_FAILED = Response::FAILED;

    public const LEVEL_DOWNLOAD_FAILED_DATA_MISSING = Response::FAILED;

    public const LEVEL_DELETE_SUCCESS = Response::SUCCESS;

    public const LEVEL_DELETE_FAILED_NO_PERMISSION = Response::FAILED;

    public const LEVEL_DESC_UPDATE_SUCCESS = Response::SUCCESS;

    public const LEVEL_DESC_UPDATE_FAILED_NO_PERMISSION = Response::FAILED;

    public const LEVEL_COMMENTS_FETCH_FAILED_INVALID_MODE = Response::FAILED;

    public const LEVEL_COMMENT_DELETE_SUCCESS = Response::SUCCESS;

    public const LEVEL_COMMENT_DELETE_FAILED = Response::FAILED;

    public const LEVEL_COMMENTS_EMPTY = Response::SPECIAL_FAILED;

    public const ACCOUNT_FRIEND_REQUEST_DELETE_SUCCESS = Response::SUCCESS;

    public const ACCOUNT_FRIEND_REQUEST_DELETE_FAILED = Response::FAILED;

    public const ACCOUNT_FRIEND_REQUEST_EMPTY = Response::SPECIAL_FAILED;

    public const ACCOUNT_BLOCK_FAILED = Response::FAILED;

    public const ACCOUNT_BLOCK_SUCCESS = Response::SUCCESS;

    public const ACCOUNT_UNBLOCK_SUCCESS = Response::SUCCESS;

    public const ACCOUNT_UNBLOCK_FAILED = Response::FAILED;

    public const USER_FETCH_FAILED_INVALID_TYPE = Response::FAILED;

    public const ACCOUNT_INFO_FETCH_FAILED_BLOCKED = Response::FAILED;

    public const ACCOUNT_FRIEND_REQUEST_SEND_FAILED_TARGET_BLOCKED = Response::FAILED;

    public const ACCOUNT_FRIEND_REMOVE_SUCCESS = Response::SUCCESS;

    public const ACCOUNT_FRIEND_REMOVE_FAILED = Response::FAILED;

    public const ACCOUNT_FRIEND_REQUEST_ACCEPT_SUCCESS = Response::SUCCESS;

    public const ACCOUNT_FRIEND_REQUEST_ACCEPT_FAILED = Response::FAILED;

    public const ACCOUNT_COMMENT_HISTORY_EMPTY = Response::SPECIAL_FAILED;

    public const ACCOUNT_COMMENT_HISTORY_FETCH_FAILED_INVALID_MODE = Response::FAILED;

    public const DAILY_OR_WEEKLY_LEVEL_FETCH_FAILED_NOT_FOUND = Response::FAILED;

    public const LEVEL_DOWNLOAD_FAILED_NO_LEVEL = Response::FAILED;

    public const LIKE_FAILED_INVALID_TYPE = Response::FAILED;

    public const LIKE_SUCCESS = Response::SUCCESS;

    public const LEVEL_SCORE_FETCH_FAILED_INVALID_TYPE = Response::FAILED;

    public const LEVEL_RATE_FAILED_USER_ALREADY_RATED = Response::FAILED;

    public const LEVEL_RATE_SUGGESTION_SUBMITTED = Response::SUCCESS;

    public const LEVEL_RATE_FAILED_ALREADY_RATED = Response::FAILED;

    public const LEVEL_RATE_SUCCESS = Response::SUCCESS;

    public const LEVEL_RATE_DEMON_FAILED_NOT_RATED = Response::FAILED;

    public const LEVEL_RATE_FAILED_UNKNOWN_ERROR = Response::FAILED;

    public const LEVEL_RATE_DEMON_SUCCESS = Response::SUCCESS;

    public const LEVEL_RATE_DEMON_SUGGESTION_SUBMITTED = Response::SUCCESS;

    public const LEVEL_RATE_DEMON_FAILED_USER_ALREADY_RATED = Response::FAILED;

    public const LEVEL_RATE_DEMON_FAILED_UNKNOWN_ERROR = Response::FAILED;

    public const LEVEL_RATE_DEMON_FAILED_NO_PERMISSION = Response::SPECIAL_FAILED;

    public const LEVEL_RATE_SUGGEST_FAILED_ALREADY_SUGGESTED = Response::FAILED;

    public const ITEM_RESTORE_FAILED = Response::FAILED;

    public const LIKE_FAILED = Response::FAILED;

    public const SONG_NOT_FOUND = Response::FAILED;

    public const ACCOUNT_COMMENT_CREATE_FAILED = Response::FAILED;

    public const SONG_DISABLED = Response::SPECIAL_FAILED;

    public const SONG_FETCH_FAILED = Response::FAILED;

    public const PROXY_FAILED = Response::FAILED;

    public static function empty(): string
    {
        $perPage = config('gdcs.perPage', 10);

        return '#' . GeometryDashAlgorithm::genPage(1, 0, $perPage);
    }
}
