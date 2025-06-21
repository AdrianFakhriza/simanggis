import React, { useEffect, useState } from "react";
import { useParams, Link } from "react-router-dom";
import { getStudentById } from "../../../_services/students";

export default function StudentDetail() {
  const { id } = useParams();
  const [student, setStudent] = useState(null);
  const [error, setError] = useState("");

  useEffect(() => {
    const fetchStudent = async () => {
      try {
        const data = await getStudentById(id);
        setStudent(data);
      } catch {
        setError("❌ Gagal mengambil data siswa.");
      }
    };
    fetchStudent();
  }, [id]);

  if (error) {
    return (
      <div className="max-w-xl p-6 mx-auto mt-10 text-red-700 bg-red-100 border border-red-300 rounded">
        {error}
      </div>
    );
  }

  if (!student) {
    return (
      <div className="flex items-center justify-center mt-10 text-blue-600">
        Memuat data siswa...
      </div>
    );
  }

  return (
    <div className="max-w-2xl p-6 mx-auto mt-10 bg-white border border-blue-100 rounded-lg shadow-md">
      {/* Kembali */}
      <div className="mb-4">
        <Link
          to="/admin/students"
          className="inline-flex items-center text-sm text-blue-600 hover:underline"
        >
          ← Kembali ke daftar siswa
        </Link>
      </div>

      {/* Header */}
      <h2 className="mb-6 text-2xl font-bold text-blue-700">Detail Siswa</h2>

      {/* Card Detail */}
      <div className="grid gap-4 text-gray-800">
        <div className="p-4 border rounded bg-blue-50 border-blue-100">
          <span className="block text-sm font-semibold text-blue-600">Nama Lengkap</span>
          <span className="text-base">{student.name}</span>
        </div>

        <div className="p-4 border rounded bg-blue-50 border-blue-100">
          <span className="block text-sm font-semibold text-blue-600">Kelas</span>
          <span className="text-base">
            {student.classes?.class_name || <em className="text-gray-500">Belum terdaftar</em>}
          </span>
        </div>

        {/* Tambahkan info lainnya di sini jika ada */}
        {/* Contoh:
        <div className="p-4 border rounded bg-blue-50 border-blue-100">
          <span className="block text-sm font-semibold text-blue-600">Status Makan</span>
          <span className="text-base">{student.meal_status || "-"}</span>
        </div> */}
      </div>
    </div>
  );
}
