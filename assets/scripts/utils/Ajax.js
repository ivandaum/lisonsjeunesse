// Example of use in Newsletter.js
class Ajax {
  constructor(url, params) {
    return new Promise((resolve, reject) => {
      const http = new XMLHttpRequest();

      if (!http) {
        console.error('Cannot create an XMLHTTP instance');
      }

      http.onreadystatechange = () => {
        if (http.readyState === http.DONE) {
          if (http.status === 200) {
            resolve(JSON.parse(http.responseText));
          } else {
            reject(new Error(http.statusText));
          }
        }
      };

      http.open('POST', url);
      http.send(params);
    });
  }
}

export default Ajax;
