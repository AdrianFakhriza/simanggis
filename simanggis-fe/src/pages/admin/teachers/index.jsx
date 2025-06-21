import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { getTeachers, deleteTeachers } from "../../../_services/teachers";

export default function AdminTeacher() {
  const [success, setSuccess] = useState("");
  const [teachers, setTeachers] = useState([]);

  const handleDelete = async (id) => {
    if (window.confirm("Apakah Anda yakin ingin menghapus guru ini?")) {
      try {
        await deleteTeachers(id);
        setTeachers((prev) => prev.filter((teacher) => teacher.id !== id));
        setSuccess("✅ Guru berhasil dihapus.");
      } catch (error) {
        console.error(error);
        setSuccess("❌ Gagal menghapus guru.");
      }
    }
  };

  useEffect(() => {
    const fetchTeachers = async () => {
      try {
        const res = await getTeachers();
        setTeachers(res);
      } catch {
        setSuccess("❌ Gagal mengambil data guru.");
      }
    };
    fetchTeachers();
  }, []);

  return (
    <div className="space-y-6">
      {/* Breadcrumb */}
      <div>
        <nav className="flex text-sm text-gray-600" aria-label="Breadcrumb">
          <ol className="inline-flex items-center space-x-1 md:space-x-3">
            <li className="inline-flex items-center">
              <Link to="/admin/dashboard" className="inline-flex items-center text-blue-600 hover:underline">
                <svg className="w-4 h-4 mr-2" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                  <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                </svg>
                Dashboard
              </Link>
            </li>
            <li>
              <span className="mx-2 text-gray-400">/</span>
            </li>
            <li className="inline-flex items-center text-blue-800 font-semibold">
              Data Guru
            </li>
          </ol>
        </nav>
      </div>

      {/* Header */}
      <div className="flex items-center justify-between">
        <h2 className="text-2xl font-bold text-blue-800"> Daftar Guru</h2>
        <Link
          to="/admin/teachers/create"
          className="px-4 py-2 font-semibold text-white bg-blue-600 rounded hover:bg-blue-700 transition"
        >
          + Tambah Guru
        </Link>
      </div>

      {/* Alert Success/Error */}
      {success && (
        <div className="px-4 py-3 text-sm text-blue-800 bg-blue-100 border border-blue-300 rounded">
          {success}
        </div>
      )}

      {/* Table */}
      <div className="overflow-x-auto bg-white border border-blue-100 rounded-lg shadow-sm">
        <table className="min-w-full text-left table-auto">
          <thead className="bg-blue-100 text-blue-900 font-semibold">
            <tr>
              <th className="px-4 py-2 border border-blue-200">No</th>
              <th className="px-4 py-2 border border-blue-200">Nama</th>
              <th className="px-4 py-2 border border-blue-200">Email</th>
              <th className="px-4 py-2 border border-blue-200 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody className="text-gray-700">
            {teachers.map((teacher, idx) => (
              <tr key={teacher.id} className="hover:bg-blue-50 transition">
                <td className="px-4 py-2 text-center border border-blue-100">{idx + 1}</td>
                <td className="px-4 py-2 border border-blue-100">{teacher.name}</td>
                <td className="px-4 py-2 border border-blue-100">{teacher.email}</td>
                <td className="px-4 py-2 border border-blue-100 text-center">
                  <div className="flex justify-center gap-3">
                    <Link
                      to={`/admin/teachers/edit/${teacher.id}`}
                      className="flex items-center px-2 py-1 text-blue-600 hover:text-blue-800 hover:underline"
                    >
                      ✏️ Edit
                    </Link>
                    <button
                      onClick={() => handleDelete(teacher.id)}
                      className="flex items-center px-2 py-1 text-red-600 hover:text-red-800 hover:underline"
                    >
                      🗑️ Hapus
                    </button>
                  </div>
                </td>
              </tr>
            ))}
            {teachers.length === 0 && (
              <tr>
                <td colSpan={4} className="py-6 text-center text-gray-500 italic">
                  Tidak ada data guru.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}
