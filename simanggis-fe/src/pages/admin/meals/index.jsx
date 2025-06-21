import React, { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import { getDistributions } from "../../../_services/meals";

export default function AdminDistribution() {
  const [distributions, setDistributions] = useState([]);
  const [filters, setFilters] = useState({
    start_date: "",
    end_date: "",
  });

  const fetchDistributions = async () => {
    try {
      const data = await getDistributions(filters);
      setDistributions(data);
    } catch (error) {
      console.error("Gagal memuat data distribusi", error);
    }
  };

  useEffect(() => {
    fetchDistributions();
    // eslint-disable-next-line react-hooks/exhaustive-deps
  }, []);

  const handleFilterChange = (e) => {
    const { name, value } = e.target;
    setFilters((prev) => ({ ...prev, [name]: value }));
  };

  const handleFilterSubmit = (e) => {
    e.preventDefault();
    fetchDistributions();
  };

  return (
    <div className="min-h-screen p-6 bg-blue-50">
      <div className="mb-6">
        <nav className="text-sm text-gray-600" aria-label="Breadcrumb">
          <ol className="inline-flex items-center space-x-1 md:space-x-3">
            <li className="inline-flex items-center">
              <Link to="/admin" className="text-blue-600 hover:underline inline-flex items-center">
                <svg className="w-4 h-4 mr-2" fill="none" stroke="currentColor" strokeWidth={2} viewBox="0 0 24 24">
                  <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                </svg>
                Dashboard
              </Link>
            </li>
            <li><span className="mx-2 text-gray-400">/</span></li>
            <li className="text-gray-500">Data Distribusi</li>
          </ol>
        </nav>
      </div>

      <div className="mb-4 flex justify-between items-center">
        <h2 className="text-3xl font-bold text-blue-800">📦 Data Distribusi</h2>
        <Link
          to="/admin/meals/create"
          className="inline-flex items-center px-4 py-2 text-white bg-blue-600 rounded-md shadow hover:bg-blue-700 transition"
        >
          <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path strokeWidth="2" d="M12 4v16m8-8H4" />
          </svg>
          Tambah Jadwal
        </Link>
      </div>

      <div className="p-6 mb-6 bg-white rounded-lg shadow-md">
        <form onSubmit={handleFilterSubmit} className="flex flex-wrap items-end gap-4">
          <div>
            <label htmlFor="start_date" className="block mb-1 text-sm font-semibold text-blue-800">Dari Tanggal</label>
            <input
              type="date"
              name="start_date"
              id="start_date"
              value={filters.start_date}
              onChange={handleFilterChange}
              className="w-40 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
            />
          </div>
          <div>
            <label htmlFor="end_date" className="block mb-1 text-sm font-semibold text-blue-800">Sampai Tanggal</label>
            <input
              type="date"
              name="end_date"
              id="end_date"
              value={filters.end_date}
              onChange={handleFilterChange}
              className="w-40 px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
            />
          </div>
          <button
            type="submit"
            className="px-5 py-2 mt-1 text-white bg-blue-600 rounded-md hover:bg-blue-700 transition"
          >
            Filter
          </button>
        </form>
      </div>

      <div className="overflow-x-auto bg-white rounded-lg shadow-md">
        <table className="min-w-full table-auto text-sm">
          <thead className="text-white bg-blue-600">
            <tr>
              <th className="px-4 py-3 text-left">Nama Kelas</th>
              <th className="px-4 py-3 text-left">Total Distribusi</th>
              <th className="px-4 py-3 text-left">Tanggal</th>
              <th className="px-4 py-3 text-left">Wali Kelas</th>
            </tr>
          </thead>
          <tbody>
            {distributions.length === 0 ? (
              <tr>
                <td colSpan="4" className="px-4 py-6 text-center text-gray-500">
                  Tidak ada distribusi ditemukan
                </td>
              </tr>
            ) : (
              distributions.map((row, index) => (
                <tr
                  key={index}
                  className={index % 2 === 0 ? "bg-white" : "bg-blue-50"}
                >
                  <td className="px-4 py-2 border-b">{row.class_name}</td>
                  <td className="px-4 py-2 border-b">{row.total_distributions}</td>
                  <td className="px-4 py-2 border-b">{row.meal_date}</td>
                  <td className="px-4 py-2 border-b">{row.teacher_name}</td>
                </tr>
              ))
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}
