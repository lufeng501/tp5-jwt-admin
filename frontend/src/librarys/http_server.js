import axios from 'axios'

class HttpServer {

  constructor() {
  }

  get (url, data = {}) {
    if (typeof(localStorage.jwt) != 'undefined') {
      var jwt = localStorage.jwt;
    } else {
      var jwt = "";
    }
    return new Promise(function (resolve, reject) {
      axios.get(
        url,
        {
          params: data,
          headers: {'X-JWT-Header': jwt}
        }
      ).then((response) => {
        let resp = response.data
        if (resp.ret === 200) {
          resolve(resp.data);
          // window.location.href = "http://localhost:8080/#/login"
        } else {
          reject(resp.data);
        }
      }).catch(function (err) {
        alert("服务器发生错误！")
        console.log(err)
      });
    });
  }
}

export default HttpServer;
