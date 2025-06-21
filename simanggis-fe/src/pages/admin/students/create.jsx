import React, { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { createStudents } from "../../../_services/students";
import { getClasses } from "../../../_services/classes";

const StudentForm = ({ onSubmit }) => {
  const [name, setName] = useState("");
  const [classId, setClassId] = useState("");
  const [classes, setClasses] = useState([]);
  const [errors, setErrors] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchClasses = async () => {
      try {
        const data = await getClasses();
        setClasses(data);
      } catch {
        setClasses([]);
      }
    };
    fetchClasses();
  }, []);

  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors([]);
    try {
      const response = await createStudents({ name, class_id: classId });
      if (response.errors) {
        setErrors(response.errors);
        return;
      }
      if (onSubmit) onSubmit();
      navigate("/admin/students");
    } catch (error) {
      console.error("Error creating student:", error);
      setErrors(["Terjadi kesalahan saat menambah siswa"]);
    }
  };

  return (
    <section className="min-h-screen py-10 bg-blue-50">
      <div className="max-w-xl px-6 mx-auto bg-white rounded-lg shadow-md">
        <h2 className="mb-6 text-2xl font-bold text-center text-blue-800">
           Form Tambah Siswa
        </h2>

        {errors.length > 0 && (
          <div className="p-4 mb-6 text-sm text-red-700 bg-red-100 border border-red-300 rounded">
            <ul className="pl-5 list-disc">
              {errors.map((error, idx) => (
                <li key={idx}>{error}</li>
              ))}
            </ul>
          </div>
        )}

        <form onSubmit={handleSubmit} className="space-y-5">
          <div>
            <label
              htmlFor="name"
              className="block mb-1 text-sm font-semibold text-blue-900"
            >
              Nama Siswa
            </label>
            <input
              type="text"
              name="name"
              id="name"
              required
              value={name}
              onChange={(e) => setName(e.target.value)}
              className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
              placeholder="Masukkan nama siswa"
            />
          </div>

          <div>
            <label
              htmlFor="class_id"
              className="block mb-1 text-sm font-semibold text-blue-900"
            >
              Kelas
            </label>
            <select
              name="class_id"
              id="class_id"
              required
              value={classId}
              onChange={(e) => setClassId(e.target.value)}
              className="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"
            >
              <option value="">-- Pilih Kelas --</option>
              {classes.map((classItem) => (
                <option key={classItem.class_id} value={classItem.class_id}>
                  {classItem.class_name}
                </option>
              ))}
            </select>
          </div>

          <input type="hidden" name="meal_status" value="" />

          <div className="flex justify-end pt-4 space-x-3">
            <button
              type="button"
              onClick={() => navigate("/admin/students")}
              className="px-4 py-2 text-gray-700 transition border border-gray-300 rounded-lg hover:bg-gray-100"
            >
              Batal
            </button>
            <button
              type="submit"
              className="px-4 py-2 font-semibold text-white transition bg-blue-600 rounded-lg hover:bg-blue-700"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </section>
  );
};

export default StudentForm;
