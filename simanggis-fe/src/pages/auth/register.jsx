import React, { useState } from "react";

export default function Register() {
  const [form, setForm] = useState({
    name: "",
    username: "",
    email: "",
    password: "",
    password_confirmation: "",
    school_name: "",
  });
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");
  const [loading, setLoading] = useState(false);

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError("");
    setSuccess("");
    try {
      const res = await fetch("http://localhost:8000/api/register", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(form),
      });
      const data = await res.json();
      if (res.ok) {
        setSuccess("Registrasi berhasil! Silakan login.");
        setForm({ name: "", username: "", email: "", password: "", password_confirmation: "", school_name: "" });
      } else if (data.errors) {
        // Tampilkan error validasi field spesifik
        const errorList = Object.entries(data.errors).map(([field, messages]) => `${field}: ${messages.join(", ")}`);
        setError(errorList.join(" | "));
      } else if (data.message) {
        setError(data.message);
      } else {
        setError("Registrasi gagal. Periksa input Anda.");
      }
    } catch {
      setError("Terjadi kesalahan server");
    }
    setLoading(false);
  };

  return (
    <div className="flex items-center justify-center min-h-screen bg-gray-100">
      <div className="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h2 className="mb-4 text-2xl font-bold text-center">Register</h2>
        {error && <div className="px-4 py-2 mb-2 text-center text-red-700 bg-red-100 rounded">{error}</div>}
        {success && <div className="px-4 py-2 mb-2 text-center text-green-700 bg-green-100 rounded">{success}</div>}
        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
          <div>
            <label htmlFor="name" className="block mb-1 font-medium">
              Nama
            </label>
            <input id="name" name="name" placeholder="Nama" value={form.name} onChange={handleChange} required className="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" />
          </div>
          <div>
            <label htmlFor="username" className="block mb-1 font-medium">
              Username
            </label>
            <input id="username" name="username" placeholder="Username" value={form.username} onChange={handleChange} required className="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" />
          </div>
          <div>
            <label htmlFor="email" className="block mb-1 font-medium">
              Email
            </label>
            <input id="email" name="email" type="email" placeholder="Email" value={form.email} onChange={handleChange} required className="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" />
          </div>
          <div>
            <label htmlFor="password" className="block mb-1 font-medium">
              Password
            </label>
            <input
              id="password"
              name="password"
              type="password"
              placeholder="Password"
              value={form.password}
              onChange={handleChange}
              required
              className="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
            />
          </div>
          <div>
            <label htmlFor="password_confirmation" className="block mb-1 font-medium">
              Konfirmasi Password
            </label>
            <input
              id="password_confirmation"
              name="password_confirmation"
              type="password"
              placeholder="Konfirmasi Password"
              value={form.password_confirmation}
              onChange={handleChange}
              required
              className="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300"
            />
          </div>
          <div>
            <label htmlFor="school_name" className="block mb-1 font-medium">
              Nama Sekolah
            </label>
            <input id="school_name" name="school_name" placeholder="Nama Sekolah" value={form.school_name} onChange={handleChange} required className="w-full px-3 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300" />
          </div>
          <button type="submit" disabled={loading} className="w-full py-2 font-semibold text-white transition bg-blue-600 rounded hover:bg-blue-700 disabled:opacity-60">
            {loading ? "Loading..." : "Register"}
          </button>
        </form>
      </div>
    </div>
  );
}
