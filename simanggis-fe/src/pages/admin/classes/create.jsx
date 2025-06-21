import React, { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { createClasses } from "../../../_services/classes";
import { getTeachers } from "../../../_services/teachers";

export default function ClassForm() {
  const [name, setName] = useState("");
  const [description, setDescription] = useState("");
  const [teacherId, setTeacherId] = useState("");
  const [teachers, setTeachers] = useState([]);

  const navigate = useNavigate();

  useEffect(() => {
    const fetchTeachers = async () => {
      try {
        const res = await getTeachers();
        setTeachers(res);
      } catch (error) {
        console.error("Gagal mengambil data guru:", error);
      }
    };
    fetchTeachers();
  }, []);

  const handleReset = () => {
    setName("");
    setDescription("");
    setTeacherId("");
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const payload = {
        class_name: name,
        description: description,
        teacher_id: teacherId,
      };
      await createClasses(payload);
      navigate("/admin/classes");
    } catch (error) {
      console.error("Gagal membuat kelas:", error);
      alert("Gagal membuat kelas. Silakan periksa input dan coba lagi.");
    }
  };

  return (
    <section className="min-h-screen px-4 py-10 bg-blue-50">
      <div className="max-w-2xl p-8 mx-auto bg-white border border-blue-100 rounded-lg shadow">
        <h2 className="mb-6 text-2xl font-bold text-blue-700">
          Tambah Kelas Baru
        </h2>
        <form onSubmit={handleSubmit}>
          <div className="grid gap-6 mb-6 sm:grid-cols-2">
            <div className="sm:col-span-2">
              <label htmlFor="name" className="block mb-2 text-sm font-medium text-blue-700">
                Nama Kelas
              </label>
              <input
                type="text"
                id="name"
                name="name"
                value={name}
                onChange={(e) => setName(e.target.value)}
                className="w-full px-4 py-2 text-gray-900 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Contoh: X IPA 1"
                required
              />
            </div>

            <div>
              <label className="block mb-2 text-sm font-medium text-blue-700">
                Wali Kelas
              </label>
              <select
                name="teacher_id"
                value={teacherId}
                onChange={(e) => setTeacherId(e.target.value)}
                className="w-full px-4 py-2 text-gray-900 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                required
              >
                <option value="">-- Pilih Wali Kelas --</option>
                {teachers.map((teacher) => (
                  <option key={teacher.id} value={teacher.id}>
                    {teacher.name}
                  </option>
                ))}
              </select>
            </div>

            <div className="sm:col-span-2">
              <label htmlFor="description" className="block mb-2 text-sm font-medium text-blue-700">
                Deskripsi
              </label>
              <textarea
                id="description"
                name="description"
                rows="4"
                value={description}
                onChange={(e) => setDescription(e.target.value)}
                className="w-full px-4 py-2 text-gray-900 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Tuliskan deskripsi kelas (opsional)"
              ></textarea>
            </div>
          </div>

          <div className="flex justify-end gap-4">
            <button
              type="button"
              onClick={handleReset}
              className="px-5 py-2.5 text-sm font-medium text-blue-600 border border-blue-600 rounded-lg hover:bg-blue-100 transition"
            >
              Reset
            </button>
            <button
              type="submit"
              className="px-5 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition"
            >
              Simpan Kelas
            </button>
          </div>
        </form>
      </div>
    </section>
  );
}
