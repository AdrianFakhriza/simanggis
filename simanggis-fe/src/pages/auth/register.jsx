import React, { useState } from "react";
import { useNavigate } from "react-router-dom";

export default function Register() {
  const navigate = useNavigate();
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

  // --- TAMBAHAN: State untuk visibilitas password ---
  const [showPassword, setShowPassword] = useState(false);
  const [showConfirmPassword, setShowConfirmPassword] = useState(false);


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
        setForm({ 
          name: "", 
          username: "", 
          email: "", 
          password: "", 
          password_confirmation: "", 
          school_name: "" 
        });
      } else if (data.errors) {
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
    <div 
      className="relative flex items-center justify-center min-h-screen px-4 overflow-hidden"
      style={{ background: 'linear-gradient(135deg, #f3e8ff 0%, #fdf2f8 50%, #e0e7ff 100%)' }}
    >
      <button
        onClick={() => navigate('/')}
        aria-label="Kembali ke halaman utama"
        className="absolute z-20 flex items-center justify-center w-12 h-12 transition-all duration-300 transform rounded-full shadow-lg bg-white/50 top-8 left-8 backdrop-blur-md hover:bg-white/75 hover:scale-110"
      >
        <svg xmlns="http://www.w3.org/2000/svg" className="w-6 h-6 text-purple-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M10 19l-7-7m0 0l7-7m-7 7h18" />
        </svg>
      </button>

      <div className="absolute w-24 h-24 bg-purple-200 rounded-full -top-5 -left-5 opacity-60 animate-pulse"></div>
      <div className="absolute w-32 h-32 bg-pink-200 rounded-full opacity-50 -bottom-10 -right-5 animate-bounce"></div>

      <div className="relative w-full max-w-md p-8 space-y-6 transition-all duration-300 shadow-xl bg-white/70 backdrop-blur-xl rounded-2xl">
        <h2 className="text-3xl font-bold text-center text-gray-800">Buat Akun Baru</h2>
        <p className="text-center text-gray-600">
          Mari bergabung untuk memonitor program.
        </p>

        {error && <div className="px-4 py-3 text-center text-red-800 bg-red-200 border border-red-300 rounded-lg">{error}</div>}
        {success && <div className="px-4 py-3 text-center text-green-800 bg-green-200 border border-green-300 rounded-lg">{success}</div>}
        
        <form onSubmit={handleSubmit} className="flex flex-col gap-4">
          <input id="name" name="name" placeholder="Nama Lengkap" value={form.name} onChange={handleChange} required className="w-full px-4 py-3 border border-purple-200 rounded-lg bg-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
          <input id="username" name="username" placeholder="Username" value={form.username} onChange={handleChange} required className="w-full px-4 py-3 border border-purple-200 rounded-lg bg-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
          <input id="email" name="email" type="email" placeholder="Alamat Email" value={form.email} onChange={handleChange} required className="w-full px-4 py-3 border border-purple-200 rounded-lg bg-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
          <input id="school_name" name="school_name" placeholder="Nama Sekolah" value={form.school_name} onChange={handleChange} required className="w-full px-4 py-3 border border-purple-200 rounded-lg bg-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" />
          
          {/* --- PERUBAHAN: Input Password dengan Ikon Mata --- */}
          <div className="relative">
            <input 
              id="password" 
              name="password" 
              type={showPassword ? "text" : "password"}
              placeholder="Password" 
              value={form.password} 
              onChange={handleChange} 
              required 
              className="w-full px-4 py-3 pr-12 border border-purple-200 rounded-lg bg-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
            />
            <button 
              type="button"
              onClick={() => setShowPassword(!showPassword)}
              className="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-600"
              aria-label={showPassword ? "Sembunyikan password" : "Tampilkan password"}
            >
              {showPassword ? (
                <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fillRule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074L3.707 2.293zM10 12a2 2 0 110-4 2 2 0 010 4z" clipRule="evenodd" /><path d="M10 12a2 2 0 110-4 2 2 0 010 4z" /></svg>
              ) : (
                <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fillRule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clipRule="evenodd" /></svg>
              )}
            </button>
          </div>

          {/* --- PERUBAHAN: Input Konfirmasi Password dengan Ikon Mata --- */}
          <div className="relative">
            <input 
              id="password_confirmation" 
              name="password_confirmation" 
              type={showConfirmPassword ? "text" : "password"}
              placeholder="Konfirmasi Password" 
              value={form.password_confirmation} 
              onChange={handleChange} 
              required 
              className="w-full px-4 py-3 pr-12 border border-purple-200 rounded-lg bg-white/50 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
            />
            <button 
              type="button"
              onClick={() => setShowConfirmPassword(!showConfirmPassword)}
              className="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-600"
              aria-label={showConfirmPassword ? "Sembunyikan konfirmasi password" : "Tampilkan konfirmasi password"}
            >
              {showConfirmPassword ? (
                 <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path fillRule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074L3.707 2.293zM10 12a2 2 0 110-4 2 2 0 010 4z" clipRule="evenodd" /><path d="M10 12a2 2 0 110-4 2 2 0 010 4z" /></svg>
              ) : (
                <svg xmlns="http://www.w3.org/2000/svg" className="w-5 h-5" viewBox="0 0 20 20" fill="currentColor"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z" /><path fillRule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clipRule="evenodd" /></svg>
              )}
            </button>
          </div>
          
          <button type="submit" disabled={loading} className="w-full py-3 mt-4 font-semibold text-white transition-all duration-300 transform rounded-full shadow-lg hover:shadow-xl hover:scale-105 disabled:opacity-70 disabled:scale-100" style={{ background: 'linear-gradient(to right, #7c3aed, #4f46e5)' }}>
            {loading ? "Memproses..." : "Register"}
          </button>
        </form>

        <p className="pt-4 text-center text-gray-600">
          Sudah punya akun?{" "}
          <button onClick={() => navigate("/login")} className="font-semibold text-purple-600 transition hover:text-purple-800 hover:underline focus:outline-none">
            Login di sini
          </button>
        </p>
      </div>
    </div>
  );
}