import API from "../_api";

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
