import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { deleteStudent, getStudents } from "../../../_services/students";

export default function AdminStudent() {
  const [success, setSuccess] = useState("");
  const [studentList, setStudentList] = useState([]);

  useEffect(() => {
    const fetchStudents = async () => {
      try {
        const students = await getStudents();
        setStudentList(students);
      } catch {
        setSuccess("Gagal mengambil data siswa.");
      }
    };
    fetchStudents();
  }, []);

  const handleDelete = async (studentId) => {
    if (window.confirm("Yakin ingin menghapus siswa ini?")) {
      try {
        await deleteStudent(studentId);
        const updatedList = studentList.filter((s) => s.student_id !== studentId);
        setStudentList(updatedList);
        setSuccess("Siswa berhasil dihapus!");
      } catch {
        setSuccess("Gagal menghapus siswa.");
      }
    }
  };

  return (
    <section className="min-h-screen px-4 py-8 bg-blue-50">
      <div className="max-w-6xl mx-auto">
        {/* Breadcrumb */}
        <div className="mb-6">
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
              <li><span className="mx-2 text-gray-400">/</span></li>
              <li className="inline-flex items-center text-gray-500">Data Murid</li>
            </ol>
          </nav>
        </div>

        {/* Header */}
        <div className="flex flex-wrap items-center justify-between mb-6 gap-2">
          <h2 className="text-2xl font-bold text-blue-700"> Data Murid</h2>
          {success && (
            <div className="text-sm text-green-800 bg-green-100 border border-green-300 rounded px-4 py-2">
              {success}
            </div>
          )}
          <Link
            to="/admin/students/create"
            className="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700 transition"
          >
            + Tambah Siswa
          </Link>
        </div>

        {/* Table */}
        <div className="p-4 overflow-x-auto bg-white border border-blue-100 rounded-lg shadow">
          <table className="min-w-full text-left table-auto">
            <thead>
              <tr className="bg-blue-100 text-blue-700">
                <th className="px-4 py-2 border">No</th>
                <th className="px-4 py-2 border">Nama</th>
                <th className="px-4 py-2 border">Kelas</th>
                <th className="px-4 py-2 border">Aksi</th>
              </tr>
            </thead>
            <tbody>
              {studentList.length === 0 ? (
                <tr>
                  <td colSpan={4} className="px-4 py-6 text-center text-gray-500">
                    Tidak ada data siswa.
                  </td>
                </tr>
              ) : (
                studentList.map((student, idx) => (
                  <tr key={student.student_id} className="hover:bg-blue-50">
                    <td className="w-12 px-4 py-2 text-center border">{idx + 1}</td>
                    <td className="px-4 py-2 border">{student.name}</td>
                    <td className="px-4 py-2 border">
                      {student.classes?.class_name || <span className="text-red-500">Belum ada kelas</span>}
                    </td>
                    <td className="px-4 py-2 border">
                      <div className="flex justify-center gap-4 text-sm">
                        <Link to={`/admin/students/detail/${student.student_id}`} className="text-blue-600 hover:underline">
                          Detail
                        </Link>
                        <Link to={`/admin/students/edit/${student.student_id}`} className="text-blue-600 hover:underline">
                          Edit
                        </Link>
                        <button
                          onClick={() => handleDelete(student.student_id)}
                          className="text-red-600 hover:underline"
                        >
                          Hapus
                        </button>
                      </div>
                    </td>
                  </tr>
                ))
              )}
            </tbody>
          </table>
        </div>
      </div>
    </section>
  );
}
