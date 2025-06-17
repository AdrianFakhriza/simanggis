import { Navigate } from "react-router-dom";

export default function GuestRoute({ children }) {
  const token = localStorage.getItem("token");

  return token ? <Navigate to="/admin" replace /> : children;
}