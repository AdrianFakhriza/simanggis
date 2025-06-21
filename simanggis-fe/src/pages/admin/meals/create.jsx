import React, { useEffect, useState } from "react";
import { createMeals } from "../../../_services/meals";
import { getClasses } from "../../../_services/classes";
import { useNavigate } from "react-router-dom";

export default function CreateMeal() {
  const [classes, setClasses] = useState([]);
  const [form, setForm] = useState({
    class_id: "",
    meal_date: "",
  });
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");
  const navigate = useNavigate();

  useEffect(() => {
    const fetchClasses = async () => {
      try {
        const data = await getClasses();
        setClasses(data);
      } catch {
        setError("Gagal mengambil data kelas.");
      }
    };
    fetchClasses();
  }, []);

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");
    setSuccess("");

    try {
      await createMeals(form);
      setSuccess("✅ Jadwal distribusi berhasil ditambahkan!");
      setTimeout(() => navigate("/admin/meals"), 1500);
    } catch (error) {
      if (error.response?.data?.errors) {
        setError("Terdapat kesalahan validasi. Silakan periksa kembali.");
      } else {
        setError("Terjadi kesalahan saat menyimpan data.");
      }
    }
  };

  return (
    <div className="min-h-screen px-4 py-10 bg-blue-50">
      <div className="max-w-2xl p-8 mx-auto bg-white rounded-lg shadow-lg">
        <h2 className="mb-6 text-3xl font-bold text-blue-700">
          Tambah Jadwal Distribusi Makanan
        </h2>

        {error && (
          <div className="p-4 mb-4 text-sm text-red-700 bg-red-100 border border-red-300 rounded-md">
            {error}
          </div>
        )}
        {success && (
          <div className="p-4 mb-4 text-sm text-green-700 bg-green-100 border border-green-300 rounded-md">
            {success}
          </div>
        )}

        <form onSubmit={handleSubmit} className="space-y-5">
          <div>
            <label htmlFor="class_id" className="block mb-1 font-semibold text-blue-800">
              Pilih Kelas
            </label>
            <select
              id="class_id"
              name="class_id"
              value={form.class_id}
              onChange={handleChange}
              className="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
              required
            >
              <option value="">-- Pilih Kelas --</option>
              {classes.map((cls) => (
                <option key={cls.class_id} value={cls.class_id}>
                  {cls.class_name} (Wali: {cls.teacher?.name || "Belum Ada"})
                </option>
              ))}
            </select>
          </div>

          <div>
            <label htmlFor="meal_date" className="block mb-1 font-semibold text-blue-800">
              Tanggal Distribusi
            </label>
            <input
              type="date"
              id="meal_date"
              name="meal_date"
              value={form.meal_date}
              onChange={handleChange}
              required
              className="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
            />
          </div>

          <div className="flex justify-end">
            <button
              type="submit"
              className="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition"
            >
              Jadwalkan
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
