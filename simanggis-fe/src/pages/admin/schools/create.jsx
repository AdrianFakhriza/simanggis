import React, { useState } from "react";
import { useNavigate } from "react-router-dom";
// import { createSchools } from "../services/schoolService"; // pastikan ini aktif

export default function SchoolForm() {
    const [form, setForm] = useState({
        school_name: "",
        address: "",
        contact_number: "",
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
            const response = await createSchools(form); // pastikan tersedia
            if (response.errors) {
                setErrors(response.errors);
                return;
            }
            navigate("/admin/schools");
        } catch (error) {
            console.error("Error creating school:", error);
            setErrors(["Terjadi kesalahan saat menambah sekolah"]);
        }
    };

    return (
        <div className="container px-4 py-10 mx-auto bg-purple-50 min-h-screen">
            <div className="max-w-xl mx-auto p-8 bg-white rounded-xl shadow-lg border border-purple-200 transition-all duration-300">
                <h2 className="mb-6 text-2xl font-extrabold text-purple-700 flex items-center gap-2">
                    🏫 Edit Informasi Sekolah
                </h2>

                {errors.length > 0 && (
                    <div className="p-4 mb-4 text-red-700 bg-red-100 border border-red-300 rounded-lg">
                        <ul className="pl-5 list-disc">
                            {errors.map((error, idx) => (
                                <li key={idx}>{error}</li>
                            ))}
                        </ul>
                    </div>
                )}

                <form onSubmit={handleSubmit} className="space-y-5">
                    <div>
                        <label htmlFor="school_name" className="block mb-1 font-semibold text-purple-700">
                            📘 Nama Sekolah
                        </label>
                        <input
                            type="text"
                            name="school_name"
                            id="school_name"
                            value={form.school_name}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                            required
                        />
                    </div>

                    <div>
                        <label htmlFor="address" className="block mb-1 font-semibold text-purple-700">
                            🗺️ Alamat
                        </label>
                        <textarea
                            name="address"
                            id="address"
                            rows="3"
                            value={form.address}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                            required
                        />
                    </div>

                    <div>
                        <label htmlFor="contact_number" className="block mb-1 font-semibold text-purple-700">
                            📞 Nomor Kontak
                        </label>
                        <input
                            type="text"
                            name="contact_number"
                            id="contact_number"
                            value={form.contact_number}
                            onChange={handleChange}
                            className="w-full px-4 py-2 border border-purple-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500"
                            required
                        />
                    </div>

                    <div className="flex justify-end space-x-3 pt-4">
                        <button
                            type="button"
                            onClick={() => navigate("/admin/schools")}
                            className="px-4 py-2 font-semibold text-purple-700 bg-purple-100 border border-purple-300 rounded-lg hover:bg-purple-200 transition"
                        >
                            Batal
                        </button>
                        <button
                            type="submit"
                            className="px-4 py-2 font-semibold text-white bg-purple-600 rounded-lg hover:bg-purple-700 transition"
                        >
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    );
}
