import API from "../_api";

// script pertama
export const getTeachers = async () => {
  const { data } = await API.get("/teacher");
  return data.data;
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
