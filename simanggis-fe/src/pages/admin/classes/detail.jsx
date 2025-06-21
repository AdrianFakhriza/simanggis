import React, { useEffect, useState } from "react";
import { Link, useParams } from "react-router-dom";
import { getClassDetail } from "../../../_services/classes";

export default function ClassDetailPage() {
  const { id } = useParams(); 
  const [classData, setClassData] = useState(null);

  useEffect(() => {
    async function fetchClass() {
      try {
        const data = await getClassDetail(id);
        setClassData(data);
      } catch (error) {
        console.error("Gagal mengambil data kelas:", error);
      }
    }

    fetchClass();
  }, [id]);

  if (!classData) return <div className="p-6 text-center text-blue-600">Loading data kelas...</div>;

  return (
    <main className="min-h-screen px-6 py-10 bg-blue-50">
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
            <li>
              <Link to="/admin/classes" className="text-blue-600 hover:underline">Data Kelas</Link>
            </li>
            <li><span className="mx-2 text-gray-400">/</span></li>
            <li className="text-gray-500">Detail Kelas</li>
          </ol>
        </nav>
      </div>

      {/* Detail Card */}
      <div className="p-6 bg-white rounded-lg shadow-md">
        <h2 className="mb-6 text-2xl font-bold text-blue-700 border-b pb-2">
          Detail Kelas: {classData.class_name}
        </h2>

        <div className="grid grid-cols-1 gap-6 md:grid-cols-2">
          <DetailItem label="Nama Kelas" value={classData.class_name} />
          <DetailItem label="Sekolah" value={classData.school?.school_name} />
          <DetailItem label="Jumlah Siswa" value={classData.students?.length || 0} />
          <DetailItem label="Wali Kelas" value={classData.teacher?.name || "-"} />
        </div>

        <div className="mt-6">
          <h3 className="mb-2 text-lg font-semibold text-blue-700">📝 Deskripsi:</h3>
          <p className="text-gray-800">{classData.description || "Tidak ada deskripsi."}</p>
        </div>
      </div>
    </main>
  );
}

// Komponen kecil untuk menampilkan label + value
function DetailItem({ label, value }) {
  return (
    <div>
      <p className="text-sm font-medium text-gray-600">{label}</p>
      <p className="text-lg font-semibold text-gray-900">{value}</p>
    </div>
  );
}
