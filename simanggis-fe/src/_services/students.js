import API from "../_api";

const API_URL = "http://localhost:8000/api";

// script pertama
export const getStudents = async () => {
  const { data } = await API.get("/student");
  return data.data;
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

export async function deleteStudent(id, token) {
  const res = await fetch(`${API_URL}/students/${id}`, {
    method: "DELETE",
    headers: { Authorization: `Bearer ${token}` },
  });
  if (!res.ok) throw new Error("Gagal menghapus siswa");
  return await res.json();
}

export async function addStudent(data, token) {
  const res = await fetch(`${API_URL}/students`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${token}`,
    },
    body: JSON.stringify(data),
  });
  if (!res.ok) throw new Error("Gagal menambah siswa");
  return await res.json();
}
