/**
 * Get URL parts by index.
 * Split / characters.
 *
 * @version 1.0 (24/11/2016)
 */
function _GET(index) {
    var params;
    if (location.hostname === "localhost") {
        params = window.location.pathname.split('/').slice(1);
    } else {
        params = window.location.pathname.split('/').slice(0);
    }
    return params[index];
}