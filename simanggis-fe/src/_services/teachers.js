import API from "../_api";

export const getTeachers = async () => {
  // const token = localStorage.getItem("token"); // atau ambil dari tempat kamu simpan token
  const token =
    "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYXBpL2xvZ2luIiwiaWF0IjoxNzUwMDgwNzg3LCJleHAiOjE3NTAwODQzODcsIm5iZiI6MTc1MDA4MDc4NywianRpIjoiTTRTWmdBSDNjREh1MWhyRSIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.9VXPTdb1jVV5QOHU6De26xSy06sdKt067-7R6pEQJmA";
  const { data } = await API.get("/teachers", {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return data;
};

/* Penambah Buku */
export const createTeachers = async (data) => {
  try {
    const response = await API.post("/teacher", data);
    return response.data;
  } catch (error) {
    console.log(error);
    throw error;
  }
};
