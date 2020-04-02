import Vue from 'vue'
import axios from 'axios'

Vue.prototype.$axios = axios

// ^ ^ ^ 这将允许你使用$.axios
//       所以你不需要在每个vue文件中导入axios
const axiosInstance = axios.create({
  baseURL: 'http://127.0.0.1:80'
})

export default ({
  Vue
}) => {
  Vue.prototype.$axios = axios
}
export {
  axiosInstance
}
