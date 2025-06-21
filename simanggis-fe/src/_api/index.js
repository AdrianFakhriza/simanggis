import axios from "axios";
import { Navigate } from "react-router-dom";

const api = axios.create({
  baseURL: "https://simanggis.pro/api",
});

api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 401) {
      localStorage.removeItem("token");
      Navigate("/login");
    }
    return Promise.reject(error);
  }
);
export default api;
