import {map} from "lodash-es";

const audioTracks = {
    '-1': 'Practice: Stay Inside Me - OcularNebula',
    '0': 'Stereo Madness - Foreverbound',
    '1': 'Back on Track - DJVI',
    '2': 'Polargeist - Step',
    '3': 'Dry Out - DJVI',
    '4': 'Base after Base - DJVI',
    '5': 'Cant Let Go - DJVI',
    '6': 'Jumper - Waterflame',
    '7': 'Time Machine - Waterflame',
    '8': 'Cycles - DJVI',
    '9': 'xStep - DJVI',
    '10': 'Clutterfunk - Waterflame',
    '11': 'Theory of Everything - DJ-Nate',
    '12': 'Electroman Adventures - Waterflame',
    '13': 'Clubstep - DJ-Nate',
    '14': 'Electrodynamix - DJ-Nate',
    '15': 'Hexagon Force - Waterflame',
    '16': 'Blast Processing - Waterflame',
    '17': 'Theory of Everything 2 - DJ-Nate',
    '18': 'Geometrical Dominator - Waterflame',
    '19': 'Deadlocked - F-777',
    '20': 'Fingerdash - MDK',
    '21': 'The Seven Seas - F-777',
    '22': 'Viking Arena - F-777',
    '23': 'Airborne Robots - F-777',
    '24': 'The Challenge - RobTop',
    '25': 'Payload - Dex Arson',
    '26': 'Beast Mode - Dex Arson',
    '27': 'Machina - Dex Arson',
    '28': 'Years - Dex Arson',
    '29': 'Frontlines - Dex Arson',
    '30': 'Space Pirates - Waterflame',
    '31': 'Striker - Waterflame',
    '32': 'Embers - Dex Arson',
    '33': 'Round 1 - Dex Arson',
    '34': 'Monster Dance Off - F-777',
    '35': 'Press Start - MDK',
    '36': 'Nock Em - Bossfight',
    '37': 'Power Trip - Boom Kitty'
};

export default audioTracks;
export const options = map(audioTracks, (value, index) => {
    return {
        label: value,
        value: index
    }
});