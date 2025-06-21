import { useState } from "react";
import { useNavigate } from "react-router-dom";
import { createTeachers } from "../../../_services/teachers";

const CreateTeacher = () => {
  const [form, setForm] = useState({
    name: "",
    username: "",
    email: "",
    password: "",
    password_confirmation: "",
  });
  const [errors, setErrors] = useState([]);
  const navigate = useNavigate();

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors([]);
    try {
      await createTeachers(form);
      navigate("/admin/teachers");
    } catch (error) {
      if (error.response?.data?.errors) {
        const validationErrors = Object.values(error.response.data.errors).flat();
        setErrors(validationErrors);
      } else {
        setErrors(["Terjadi kesalahan saat menyimpan data."]);
      }
    }
  };

  return (
    <div className="min-h-screen px-4 py-10 bg-blue-50">
      <div className="max-w-2xl p-8 mx-auto bg-white rounded-lg shadow-lg">
        {/* Breadcrumb */}
        <nav className="mb-6 text-sm text-gray-600" aria-label="Breadcrumb">
          <ol className="inline-flex items-center space-x-2">
            <li>
              <a href="/admin/dashboard" className="text-blue-600 hover:underline flex items-center">
                <svg className="w-4 h-4 mr-1" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24">
                  <path d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0h6" />
                </svg>
                Dashboard
              </a>
            </li>
            <li>
              <span className="text-gray-400">/</span>
            </li>
            <li className="text-gray-500">Data Guru</li>
          </ol>
        </nav>

        {/* Heading */}
        <h2 className="mb-6 text-2xl font-bold text-blue-700">Tambah Guru Baru</h2>

        {/* Error */}
        {errors.length > 0 && (
          <div className="p-4 mb-6 text-red-700 bg-red-100 border border-red-300 rounded">
            <ul className="pl-5 list-disc">
              {errors.map((error, idx) => (
                <li key={idx}>{error}</li>
              ))}
            </ul>
          </div>
        )}

        {/* Form */}
        <form onSubmit={handleSubmit} className="space-y-5">
          {[
            { name: "name", label: "Nama Lengkap", type: "text" },
            { name: "username", label: "Username", type: "text" },
            { name: "email", label: "Email", type: "email" },
            { name: "password", label: "Password", type: "password" },
            { name: "password_confirmation", label: "Konfirmasi Password", type: "password" },
          ].map((field) => (
            <div key={field.name}>
              <label htmlFor={field.name} className="block mb-1 text-sm font-semibold text-blue-800">
                {field.label}
              </label>
              <input
                type={field.type}
                id={field.name}
                name={field.name}
                value={form[field.name]}
                onChange={handleChange}
                required
                className="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
              />
            </div>
          ))}

          {/* Buttons */}
          <div className="flex justify-end pt-4 space-x-4">
            <button
              type="button"
              onClick={() => navigate("/admin/teachers")}
              className="px-4 py-2 text-gray-700 transition bg-gray-100 border border-gray-300 rounded hover:bg-gray-200"
            >
              Batal
            </button>
            <button
              type="submit"
              className="px-6 py-2 text-white transition bg-blue-600 rounded hover:bg-blue-700"
            >
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default CreateTeacher;
