import API from "../_api";

export const getTeachers = async () => {
  const token = localStorage.getItem("token"); // atau ambil dari tempat kamu simpan token
  const { data } = await API.get("/teachers", {
    headers: {
      Authorization: `Bearer ${token}`,
      Accept: "application/json",
    },
  });
  return data;
};

export const createTeachers = async (data) => {
  try {
    const token = localStorage.getItem("token"); // atau ambil dari tempat kamu simpan token
    const response = await API.post("/teachers", data, {
      headers: {
        Authorization: `Bearer ${token}`,
        "Content-Type": "multipart/form-data", // penting kalau kamu pakai FormData
      },
    });

    return response.data;
  } catch (error) {
    console.error(error);
    throw error;
  }
};

export const deleteTeachers = async (id) => {
  try {
    const token = localStorage.getItem("token"); // atau ambil dari tempat kamu simpan token
    const response = await API.delete("/teachers/" + id, {
      headers: {
        Authorization: `Bearer ${token}`,
      },
    });
    return response;
  } catch (error) {
    console.error(error);
    throw error;
  }
};

const API_URL = "http://localhost:8000/api";

export async function editTeacher(id, data, token) {
  const res = await fetch(`${API_URL}/teachers/${id}`, {
    method: "PUT",
    headers: {
      "Content-Type": "application/json",
      Authorization: `Bearer ${token}`,
    },
    body: JSON.stringify(data),
  });
  if (!res.ok) throw new Error("Gagal mengedit guru");
  return await res.json();
}
