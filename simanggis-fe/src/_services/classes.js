import API from "../_api";

// script pertama
export const getClasses = async () => {
    const token = localStorage.getItem("token");
    const { data } = await API.get("/classes", {
        headers: {
            Authorization: `Bearer ${token}`,
            Accept: "application/json",
        },
    });
    return data;
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
