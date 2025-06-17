import React, { useEffect, useState } from "react";
import { editTeacher } from "../../../_services/teachers";

export default function EditTeacher({ match, history }) {
  const [form, setForm] = useState({ name: "", username: "", email: "" });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState("");
  const [success, setSuccess] = useState("");
  const token = localStorage.getItem("token");
  const teacherId = match?.params?.id;

  useEffect(() => {
    // TODO: fetch teacher detail jika ada endpoint detail
  }, [teacherId]);

  const handleChange = (e) => setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError("");
    setSuccess("");
    try {
      await editTeacher(teacherId, form, token);
      setSuccess("Guru berhasil diupdate!");
      setTimeout(() => history.push("/admin/teachers"), 1000);
    } catch (e) {
      setError(e.message);
    }
    setLoading(false);
  };

  return (
    <form onSubmit={handleSubmit}>
      <h2>Edit Guru</h2>
      {error && <div style={{ color: "red" }}>{error}</div>}
      {success && <div style={{ color: "green" }}>{success}</div>}
      <input name="name" placeholder="Nama" value={form.name} onChange={handleChange} required />
      <input name="username" placeholder="Username" value={form.username} onChange={handleChange} required />
      <input name="email" type="email" placeholder="Email" value={form.email} onChange={handleChange} required />
      <button type="submit" disabled={loading}>
        {loading ? "Loading..." : "Simpan"}
      </button>
    </form>
  );
}
