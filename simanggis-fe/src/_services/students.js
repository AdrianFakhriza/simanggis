import API from "../_api";

// script pertama
export const getStudents = async () => {
  const token = localStorage.getItem("token"); // Ambil token dari localStorage

  const { data } = await API.get("/students", {
    headers: {
      Authorization: `Bearer ${token}`,      // Header otorisasi
      Accept: "application/json",            // Minta respon dalam format JSON
    },
  });

  return data;
};
/* Penambah Buku */
export const createStudents = async (data) => {
  try {
    const response = await API.post("/student", data);
    return response.data;
  } catch (error) {
    console.log(error);
    throw error;
  }
};

export const getStudentById = async (id) => {
    const token = localStorage.getItem("token");
    const { data } = await API.get(`/students/${id}`, {
        headers: {
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
        },
    });
    return data;
};

export const updateStudent = async (id, data) => {
    const token = localStorage.getItem("token");
    return await API.put(`/students/${id}`, data, {
        headers: {
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
        },
    });
};
