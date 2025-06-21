import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { getSchools } from "../../../_services/schools";
import { School, Phone, MapPin, Pencil } from "lucide-react";

export default function AdminSchools() {
  const [school, setSchool] = useState(null);

  useEffect(() => {
    async function fetchSchool() {
      try {
        const res = await getSchools();
        setSchool(Array.isArray(res) ? res[0] : res);
      } catch (error) {
        console.error("Failed to fetch school:", error);
      }
    }

    fetchSchool();
  }, []);

  return (
    <div className="max-w-4xl px-4 py-10 mx-auto">
      {/* Breadcrumb */}
      <div className="mb-6">
        <nav className="flex text-sm text-gray-600" aria-label="Breadcrumb">
          <ol className="inline-flex items-center space-x-2">
            <li className="inline-flex items-center">
              <Link to="/admin/dashboard" className="flex items-center text-blue-600 hover:underline">
                <svg className="w-4 h-4 mr-1" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                  <path d="M3 12l2-2 7-7 7 7 2 2M5 10v10a1 1 0 001 1h3m10-11v10a1 1 0 01-1 1h-3m-6 0h6" />
                </svg>
                Dashboard
              </Link>
              <span className="mx-2 text-gray-400">/</span>
            </li>
            <li className="text-gray-500">Data Sekolah</li>
          </ol>
        </nav>
      </div>

      {/* Header */}
      <div className="flex items-center justify-between mb-6">
        <h2 className="text-2xl font-bold text-gray-800">Profil Sekolah</h2>
        <Link
          to="/admin/schools/detail"
          className="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded hover:bg-blue-700"
        >
          <Pencil className="w-4 h-4 mr-2" />
          Edit Informasi
        </Link>
      </div>

      {/* Cards Grid */}
      <div className="grid gap-6 md:grid-cols-2">
        {/* Card - Nama Sekolah */}
        <div className="p-5 border rounded-lg shadow-sm bg-white">
          <div className="flex items-center mb-2 text-blue-600">
            <School className="w-5 h-5 mr-2" />
            <h4 className="text-md font-semibold">Nama Sekolah</h4>
          </div>
          <p className="text-gray-800">{school?.school_name || "—"}</p>
        </div>

        {/* Card - Alamat */}
        <div className="p-5 border rounded-lg shadow-sm bg-white">
          <div className="flex items-center mb-2 text-blue-600">
            <MapPin className="w-5 h-5 mr-2" />
            <h4 className="text-md font-semibold">Alamat</h4>
          </div>
          <p className="text-gray-800 whitespace-pre-wrap">{school?.address || "—"}</p>
        </div>

        {/* Card - Nomor Kontak */}
        <div className="p-5 border rounded-lg shadow-sm bg-white">
          <div className="flex items-center mb-2 text-blue-600">
            <Phone className="w-5 h-5 mr-2" />
            <h4 className="text-md font-semibold">Nomor Kontak</h4>
          </div>
          <p className="text-gray-800">{school?.contact_number || "—"}</p>
        </div>
      </div>
    </div>
  );
}