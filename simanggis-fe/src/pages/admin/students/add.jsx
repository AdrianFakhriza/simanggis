import React, { useState } from "react";
import { addStudent } from "../../_services/students";

export default function AddStudent({ history }) {
  const [form, setForm] = useState({ name: "", class_id: "" });
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");
  const [loading, setLoading] = useState(false);
  const token = localStorage.getItem("token");

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError("");
    setSuccess("");
    try {
      await addStudent(form, token);
      setSuccess("Siswa berhasil ditambah!");
      setTimeout(() => history.push("/admin/students"), 1000);
    } catch (e) {
      setError(e.message);
    }
    setLoading(false);
  };

  return (
    <form onSubmit={handleSubmit}>
      <h2>Tambah Siswa</h2>
      {error && <div style={{ color: "red" }}>{error}</div>}
      {success && <div style={{ color: "green" }}>{success}</div>}
      <input name="name" placeholder="Nama Siswa" value={form.name} onChange={handleChange} required />
      <input name="class_id" placeholder="ID Kelas" value={form.class_id} onChange={handleChange} required />
      <button type="submit" disabled={loading}>
        {loading ? "Loading..." : "Tambah"}
      </button>
    </form>
  );
}
