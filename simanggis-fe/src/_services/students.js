import API from "../_api";

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
