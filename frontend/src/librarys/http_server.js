import axios from 'axios'

class HttpServer {

  constructor() {
    // this.$route = new VueRouter
  }

  get(url, data = {}) {

    if (typeof(localStorage.jwt) != 'undefined') {
      var jwt = localStorage.jwt;
    } else {
      var jwt = "";
    }

    console.log('localStorage.jwt',localStorage.jwt)

    console.log('jwt',jwt)

    let _this = this
    var promise = new Promise(function(resolve, reject) {
      axios.get(
        url,
        {
          headers: {'X-JWT-Header': jwt}
        }
      ).then((response) => {
        console.log('axios.get')
        console.log(response)
        let resp = response.data
        if (resp.code == 1){
          // window.location.href = "/login"
          resolve(resp);
        } else {
          reject(resp);
        }
      }).catch(function(response) {
        console.log('axios.get服务器出错，无法获取数据')
        console.log(response)
      });
    });

    return promise;
  }
}

export default HttpServer;
