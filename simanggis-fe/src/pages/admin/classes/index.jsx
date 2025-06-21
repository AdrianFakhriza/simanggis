import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { getClasses, deleteClass } from "../../../_services/classes";

export default function AdminClasses() {
  const [classes, setClasses] = useState([]);

  useEffect(() => {
    async function fetchClasses() {
      try {
        const res = await getClasses();
        setClasses(res);
      } catch (error) {
        console.error("Failed to fetch classes:", error);
      }
    }

    fetchClasses();
  }, []);

  return (
    <section className="p-4 sm:p-6">
      {/* Breadcrumb */}
      <div className="mb-6">
        <nav className="flex text-sm text-gray-600" aria-label="Breadcrumb">
          <ol className="inline-flex items-center space-x-1 md:space-x-3">
            <li className="inline-flex items-center">
              <Link
                to="/admin/dashboard"
                className="inline-flex items-center text-blue-600 hover:underline"
              >
                <svg
                  className="w-4 h-4 mr-2"
                  fill="none"
                  stroke="currentColor"
                  strokeWidth="2"
                  viewBox="0 0 24 24"
                >
                  <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6"></path>
                </svg>
                Dashboard
              </Link>
            </li>
            <li>
              <span className="mx-2 text-gray-400">/</span>
            </li>
            <li className="inline-flex items-center text-blue-800 font-semibold">
              Data Kelas
            </li>
          </ol>
        </nav>
      </div>

      {/* Header */}
      <div className="flex items-center justify-between mb-6">
        <h2 className="text-2xl font-bold text-blue-800"> Daftar Kelas</h2>
        <Link
          to="/admin/classes/create"
          className="px-4 py-2 font-semibold text-white bg-blue-600 rounded hover:bg-blue-700 transition"
        >
          + Tambah Kelas
        </Link>
      </div>

      {/* Table */}
      <div className="p-4 overflow-x-auto bg-white border border-blue-100 rounded-lg shadow-sm">
        <table className="min-w-full text-left table-auto">
          <thead className="bg-blue-100 text-blue-800 font-semibold">
            <tr>
              <th className="px-4 py-2 border border-blue-200">No</th>
              <th className="px-4 py-2 border border-blue-200">Nama</th>
              <th className="px-4 py-2 border border-blue-200">Wali Kelas</th>
              <th className="px-4 py-2 border border-blue-200 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody className="text-gray-700">
            {classes.map((item, index) => (
              <tr
                key={item.class_id || item.id || index}
                className="hover:bg-blue-50 transition"
              >
                <td className="px-4 py-2 text-center border border-blue-100">{index + 1}</td>
                <td className="px-4 py-2 border border-blue-100">{item.class_name || item.nama || "-"}</td>
                <td className="px-4 py-2 border border-blue-100">
                  {item.teacher?.name || "Belum ada wali kelas"}
                </td>
                <td className="px-4 py-2 text-center border border-blue-100">
                  <div className="flex justify-center gap-3">
                    <Link
                      to={`/admin/classes/detail/${item.class_id || item.id || ""}`}
                      className="text-green-600 hover:text-green-800 hover:underline"
                    >
                      👁️ Detail
                    </Link>
                    <Link
                      to={`/admin/classes/edit/${item.class_id || item.id || ""}`}
                      className="text-blue-600 hover:text-blue-800 hover:underline"
                    >
                      ✏️ Edit
                    </Link>
                    <button
                      onClick={async () => {
                        if (window.confirm("Yakin ingin menghapus kelas ini?")) {
                          try {
                            await deleteClass(item.class_id || item.id);
                            setClasses((prev) =>
                              prev.filter((cls) => cls.class_id !== item.class_id)
                            );
                          } catch (err) {
                            alert("Gagal menghapus kelas. Silakan coba lagi.");
                          }
                        }
                      }}
                      className="text-red-600 hover:text-red-800 hover:underline"
                    >
                      🗑️ Hapus
                    </button>
                  </div>
                </td>
              </tr>
            ))}
            {classes.length === 0 && (
              <tr>
                <td colSpan="4" className="py-6 text-center text-gray-500 italic">
                  Tidak ada data kelas.
                </td>
              </tr>
            )}
          </tbody>
        </table>
      </div>
    </section>
  );
}
