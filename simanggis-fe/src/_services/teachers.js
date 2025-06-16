import API from "../_api";

export const getTeachers = async () => {
  // const token = localStorage.getItem("token"); // atau ambil dari tempat kamu simpan token
  const token = "";
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
    const token = "";
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
    const token = "";
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
