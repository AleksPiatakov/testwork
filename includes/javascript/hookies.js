'use strict';

function addHookie($key, $value, $sortOrder = 10) {
    if(typeof  hookie != 'undefined') {
        if(typeof  hookie[$key] != 'object') {
            hookie[$key] = {};
        }
        if(typeof  hookie[$key][$sortOrder] != 'object') {
            hookie[$key][$sortOrder] = [];
        }
        hookie[$key][$sortOrder].push($value);
    }
}

function doHookie($key) {
    if(typeof  hookie == 'object' && typeof hookie[$key] == 'object') {
        for(let sortOrder in  hookie[$key]) {
            if(hookie[$key][sortOrder].length > 0) {
                for(let index in  hookie[$key][sortOrder]) {
                    try {
                        eval(hookie[$key][sortOrder][index]);
                        console.log(hookie[$key][sortOrder][index]);
                    }
                    catch(e) {
                        console.log(e);
                    }
                }
            }
        }
    }
}