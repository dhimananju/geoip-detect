export const setLocalStorage = function (variable, value, ttl_sec) {
    var data = { value: value, expires_at: new Date().getTime() + (ttl_sec * 1000) / 1 };
    localStorage.setItem(variable.toString(), JSON.stringify(data));
};

export const getLocalStorage = function (variable) {
        var data = JSON.parse(localStorage.getItem(variable.toString()));
        if (data !== null) {
            if (data.expires_at !== null && data.expires_at < new Date().getTime()) {
                localStorage.removeItem(variable.toString());
            } else {
                return data.value;
            }
        }
        return null;
    }