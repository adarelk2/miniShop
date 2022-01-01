/*/
allways when you used get,post function you get 3 variables, state,status,msg from the server
*/
export const get = (_url, _data) => // _url = the url you want to send or get detalis, _data = object
    {
        return new Promise((resolve, reject) => {
            $.ajax({
                url: _url,
                method: "GET",
                data: _data,
                success: function(res) {
                    try {
                        let data = JSON.parse(res);
                        console.log(data);
                        if (data.status >= 200 && data.status <= 204)
                            resolve(data); /// after you got the callback you have to check if state(data.state) is true or false
                        else {
                            reject(data);
                        }
                    } catch {
                        console.log(res);
                        reject(res);
                    }
                },
                error: function(e) {
                    console.log(e);
                    reject(e);
                }
            })
        })
    }
export const post = (_url, _data) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: _url,
            method: "POST",
            data: _data,
            success: function(res) {
                try {
                    let data = JSON.parse(res);
                    console.log(data);
                    if (data.status >= 200 && data.status <= 204)
                        resolve(data); /// after you got the callback you have to check if state(data.state) is true or false
                    else {
                        reject(data);
                    }
                } catch {
                    console.log(res);
                    reject(res);
                }
            },
            error: function(e) {
                console.log(e);
                reject(e);
            }
        })
    })
}


export const postFile = (_url, _data) => {
    return new Promise((resolve, reject) => {
        $.ajax({
            url: _url,
            method: "POST",
            data: _data,
            contentType: false,
            processData: false,
            success: function(res) {
                try {
                    let data = JSON.parse(res);
                    if (data.status >= 200 && data.status <= 204) resolve(data);
                    /// after you got the callback you have to check if state(data.state) is true or false
                    else {
                        reject(data);
                    }
                } catch {
                    reject(res);
                }
            },
            error: function(e) {
                reject(e);
            },
        });
    });
};