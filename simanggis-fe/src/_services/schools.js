import API from "../_api";

// script pertama
export const getSchools = async () => {
  const { data } = await API.get("/school");
  return data.data;
};

/* Penambah Buku */
export const createSchools = async (data) => {
  try {
    const response = await API.post("/school", data);
    return response.data;
  } catch (error) {
    console.log(error);
    throw error;
  }
};
