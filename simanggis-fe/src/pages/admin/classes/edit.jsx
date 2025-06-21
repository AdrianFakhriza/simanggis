import React, { useEffect, useState } from "react";
import { useParams, useNavigate } from "react-router-dom";
import { getClassDetail, updateClass } from "../../../_services/classes";
import { getTeachers } from "../../../_services/teachers";

export default function EditClass() {
  const { id } = useParams();
  const navigate = useNavigate();

  const [name, setName] = useState("");
  const [description, setDescription] = useState("");
  const [teacherId, setTeacherId] = useState("");
  const [teachers, setTeachers] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const classData = await getClassDetail(id);
        setName(classData.class_name);
        setDescription(classData.description || "");
        setTeacherId(classData.teacher_id || classData.teacher?.id || "");

        const teacherList = await getTeachers();
        setTeachers(teacherList);
      } catch (error) {
        console.error("Gagal mengambil data:", error);
      }
    };

    fetchData();
  }, [id]);

  const handleSubmit = async (e) => {
    e.preventDefault();
    try {
      const payload = {
        class_name: name,
        description: description,
        teacher_id: teacherId,
      };
      await updateClass(id, payload);
      navigate("/admin/classes");
    } catch (error) {
      console.error("Gagal memperbarui kelas:", error);
      alert("Gagal menyimpan perubahan. Periksa kembali input Anda.");
    }
  };

  return (
    <section className="bg-blue-50 min-h-screen">
      <div className="max-w-2xl px-6 py-10 mx-auto bg-white rounded-lg shadow-md">
        <h2 className="mb-6 text-2xl font-bold text-blue-700 border-b pb-2">
          Edit Data Kelas
        </h2>
        <form onSubmit={handleSubmit} className="space-y-6">
          {/* Nama Kelas */}
          <div>
            <label htmlFor="name" className="block mb-1 font-medium text-blue-800">
              Nama Kelas
            </label>
            <input
              type="text"
              id="name"
              value={name}
              onChange={(e) => setName(e.target.value)}
              required
              className="w-full px-4 py-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            />
          </div>

          {/* Wali Kelas */}
          <div>
            <label className="block mb-1 font-medium text-blue-800">
              Wali Kelas
            </label>
            <select
              value={teacherId}
              onChange={(e) => setTeacherId(e.target.value)}
              required
              className="w-full px-4 py-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            >
              <option value="">-- Pilih Wali Kelas --</option>
              {teachers.map((teacher) => (
                <option key={teacher.id} value={teacher.id}>
                  {teacher.name}
                </option>
              ))}
            </select>
          </div>

          {/* Deskripsi */}
          <div>
            <label htmlFor="description" className="block mb-1 font-medium text-blue-800">
              Deskripsi (Opsional)
            </label>
            <textarea
              id="description"
              rows="4"
              value={description}
              onChange={(e) => setDescription(e.target.value)}
              placeholder="Tuliskan deskripsi kelas di sini..."
              className="w-full px-4 py-2 border border-blue-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
            />
          </div>

          {/* Tombol */}
          <div className="flex justify-end space-x-3">
            <button
              type="button"
              onClick={() => navigate("/admin/classes")}
              className="px-4 py-2 text-gray-600 border border-gray-400 rounded hover:bg-gray-100"
            >
              Batal
            </button>
            <button
              type="submit"
              className="px-6 py-2 text-white bg-blue-600 rounded hover:bg-blue-700"
            >
              Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </section>
  );
}
