import API from "../_api";

const API_URL = "http://localhost:8000/api";

// script pertama
export const getClasses = async () => {
  const { data } = await API.get("/class");
  return data.data;
};

/* script kedua cek response setelah script pertama error
export const getBooks = async () => {
  const response = await API.get("/books")  
  console.log("Response from API:", response.data); // log response mentah
  return response.data 
} */

/* Penambah Buku */
export const createClasses = async (data) => {
  try {
    const response = await API.post("/class", data);
    return response.data;
  } catch (error) {
    console.log(error);
    throw error;
  }
};

/* Edit Class */
export const updateClasses = async (id, data) => {
  try {
    const response = await API.put(`/class/${id}`, data);
    return response.data;
  } catch (error) {
    console.log(error);
    throw error;
  }
};

/* Delete Class */
export const deleteClasses = async (id) => {
  try {
    const response = await API.delete(`/class/${id}`);
    return response.data;
  } catch (error) {
    console.log(error);
    throw error;
  }
};

export async function deleteClass(id, token) {
  const res = await fetch(`${API_URL}/classes/${id}`, {
    method: "DELETE",
    headers: { Authorization: `Bearer ${token}` },
  });
  if (!res.ok) throw new Error("Gagal menghapus kelas");
  return await res.json();
}

export async function editClass(id, data, token) {
  const res = await fetch(`${API_URL}/classes/${id}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${token}`,
    },
    body: JSON.stringify(data),
  });
  if (!res.ok) throw new Error("Gagal mengedit kelas");
  return await res.json();
}

export async function getClassDetail(id, token) {
  const res = await fetch(`${API_URL}/classes/${id}`, {
    headers: { Authorization: `Bearer ${token}` },
  });
  if (!res.ok) throw new Error("Gagal mengambil detail kelas");
  return await res.json();
}
