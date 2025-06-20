import React, { useState, useEffect } from 'react';

// Simple chart component using Canvas API
const SimpleChart = ({ data, labels }) => {
  const canvasRef = React.useRef(null);

  useEffect(() => {
    const canvas = canvasRef.current;
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const width = canvas.width;
    const height = canvas.height;

    // Clear canvas
    ctx.clearRect(0, 0, width, height);

    // Chart styling
    const padding = 40;
    const chartWidth = width - padding * 2;
    const chartHeight = height - padding * 2;

    const maxValue = Math.max(...data.sudah, ...data.belum, 1);

    // Draw grid
    ctx.strokeStyle = '#f3f4f6';
    ctx.lineWidth = 1;
    for (let i = 0; i <= 4; i++) {
      const y = padding + (chartHeight / 4) * i;
      ctx.beginPath();
      ctx.moveTo(padding, y);
      ctx.lineTo(width - padding, y);
      ctx.stroke();
    }

    // Draw lines
    const drawLine = (values, color, fill = false) => {
      if (values.length === 0) return;

      ctx.strokeStyle = color;
      ctx.lineWidth = 3;
      ctx.beginPath();

      values.forEach((value, index) => {
        const x = padding + (chartWidth / (values.length - 1)) * index;
        const y = padding + chartHeight - (value / maxValue) * chartHeight;

        if (index === 0) {
          ctx.moveTo(x, y);
        } else {
          ctx.lineTo(x, y);
        }
      });

      if (fill) {
        ctx.lineTo(padding + chartWidth, padding + chartHeight);
        ctx.lineTo(padding, padding + chartHeight);
        ctx.closePath();
        ctx.globalAlpha = 0.2;
        ctx.fillStyle = color;
        ctx.fill();
        ctx.globalAlpha = 1;
      }

      ctx.stroke();

      // Draw points
      ctx.fillStyle = color;
      values.forEach((value, index) => {
        const x = padding + (chartWidth / (values.length - 1)) * index;
        const y = padding + chartHeight - (value / maxValue) * chartHeight;
        ctx.beginPath();
        ctx.arc(x, y, 4, 0, 2 * Math.PI);
        ctx.fill();
      });
    };

    // Draw data
    drawLine(data.sudah, '#9333ea', true);
    drawLine(data.belum, '#ec4899', true);

    // Draw labels
    ctx.fillStyle = '#6b7280';
    ctx.font = '12px sans-serif';
    ctx.textAlign = 'center';
    labels.forEach((label, index) => {
      const x = padding + (chartWidth / (labels.length - 1)) * index;
      ctx.fillText(label, x, height - 10);
    });

  }, [data, labels]);

  return <canvas ref={canvasRef} width={600} height={300} className="w-full h-auto" />;
};

export default function SchoolShow({ schoolId = 1 }) {
  const [school, setSchool] = useState(null);
  const [loading, setLoading] = useState(true);
  const [chartFilter, setChartFilter] = useState('minggu');

  useEffect(() => {
    fetchSchool();
    // eslint-disable-next-line
  }, [schoolId]);

  const fetchSchool = async () => {
    try {
      const response = await fetch(`/api/schoolsPublic/${schoolId}`);
      const json = await response.json();
      setSchool(json.data); // <-- ambil dari data
      setLoading(false);
    } catch (error) {
      setSchool(null);
      setLoading(false);
    }
  };

  // Ambil data chart sesuai filter
  const getChartData = () => {
    if (!school) return { sudah: [], belum: [], labels: [] };
    if (chartFilter === 'minggu') {
      return {
        sudah: (school.dataMingguSudah || []).map(Number),
        belum: (school.dataMingguBelum || []).map(Number),
        labels: school.labelsMinggu || [],
      };
    }
    if (chartFilter === 'bulan') {
      return {
        sudah: (school.dataBulanSudah || []).map(Number),
        belum: (school.dataBulanBelum || []).map(Number),
        labels: school.labelsBulan || [],
      };
    }
    if (chartFilter === 'tahun') {
      return {
        sudah: (school.dataTahunSudah || []).map(Number),
        belum: (school.dataTahunBelum || []).map(Number),
        labels: school.labelsTahun || [],
      };
    }
    return { sudah: [], belum: [], labels: [] };
  };

  if (loading) {
    return (
      <div 
        className="flex items-center justify-center min-h-screen"
        style={{
          background: 'linear-gradient(135deg, #f3e8ff 0%, #fdf2f8 50%, #e0e7ff 100%)'
        }}
      >
        <div className="text-center">
          <div className="w-16 h-16 border-4 border-purple-200 border-dashed rounded-full animate-spin border-t-purple-600"></div>
          <p className="mt-4 text-lg text-purple-600">Memuat detail sekolah...</p>
        </div>
      </div>
    );
  }

  if (!school) {
    return (
      <div 
        className="flex items-center justify-center min-h-screen"
        style={{
          background: 'linear-gradient(135deg, #f3e8ff 0%, #fdf2f8 50%, #e0e7ff 100%)'
        }}
      >
        <div className="text-center">
          <div className="inline-flex items-center justify-center w-16 h-16 mb-4 bg-red-100 rounded-full">
            <svg className="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
            </svg>
          </div>
          <h3 className="mb-2 text-xl font-semibold text-gray-900">Sekolah tidak ditemukan</h3>
          <p className="mb-4 text-gray-500">Data sekolah yang Anda cari tidak tersedia</p>
          <button
            onClick={() => window.history.back()}
            className="px-6 py-2 font-semibold text-white transition-all duration-300 rounded-full shadow-lg hover:shadow-xl"
            style={{
              background: 'linear-gradient(to right, #9333ea, #6366f1)',
            }}
          >
            Kembali
          </button>
        </div>
      </div>
    );
  }

  return (
    <div 
      className="min-h-screen px-4 py-16"
      style={{
        background: 'linear-gradient(135deg, #f3e8ff 0%, #fdf2f8 50%, #e0e7ff 100%)'
      }}
    >
      <div className="max-w-6xl mx-auto">
        {/* Back Button */}
        <div className="mb-8">
          <button
            onClick={() => window.history.back()}
            className="inline-flex items-center gap-2 px-4 py-2 text-purple-600 transition-all duration-300 border border-purple-200 rounded-full bg-white/80 backdrop-blur-sm hover:shadow-lg hover:bg-white"
          >
            <svg className="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M15 19l-7-7 7-7" />
            </svg>
            Kembali
          </button>
        </div>

        {/* Header Section */}
        <div className="mb-12 text-center">
          <div className="inline-flex items-center gap-2 px-6 py-3 mb-8 transition-all duration-300 border border-purple-200 rounded-full shadow-lg bg-white/80 backdrop-blur-sm hover:shadow-xl">
            <span className="font-medium text-purple-600">Detail Sekolah</span>
            <svg className="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
            </svg>
          </div>
          
          <h1 className="mb-4 text-4xl font-bold leading-tight text-gray-800 md:text-5xl">
            {school.school_name}
          </h1>
          
          <p className="max-w-2xl mx-auto mb-8 text-lg leading-relaxed text-gray-600">
            {school.address || '-'}
          </p>
        </div>

        {/* Statistics Overview */}
        <div className="mb-12 overflow-hidden transition-all duration-500 border border-purple-100 shadow-lg bg-white/80 backdrop-blur-sm rounded-2xl">
          <div className="p-8 bg-gradient-to-br from-purple-50 to-pink-50">
            <div className="flex flex-wrap items-center justify-center gap-8 mb-6">
              <div className="text-center">
                <span className="text-4xl font-bold text-purple-600">{school.siswaSudahMakan || 0}</span>
                <span className="block text-sm text-gray-500">Sudah Makan</span>
              </div>
              <div className="text-center">
                <span className="text-4xl font-bold text-pink-600">{school.siswaBelumMakan || 0}</span>
                <span className="block text-sm text-gray-500">Belum Makan</span>
              </div>
              <div className="text-center">
                <span className="text-4xl font-bold text-indigo-600">
                  {((school.siswaSudahMakan + school.siswaBelumMakan) > 0
                    ? ((school.siswaSudahMakan / (school.siswaSudahMakan + school.siswaBelumMakan)) * 100).toFixed(1)
                    : 0)}%
                </span>
                <span className="block text-sm text-gray-500">Persentase</span>
              </div>
            </div>

            {/* Stats Tags */}
            <div className="flex flex-wrap justify-center gap-3 mb-8">
              <span className="px-4 py-2 text-sm font-medium text-purple-800 bg-purple-100 rounded-full">
                👨‍🏫 Guru: {school.users?.filter(u => u.role === 'guru').length || 0}
              </span>
              <span className="px-4 py-2 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">
                🏫 Kelas: {school.classes?.length || 0}
              </span>
              <span className="px-4 py-2 text-sm font-medium text-green-800 bg-green-100 rounded-full">
                👨‍🎓 Siswa: {school.students?.length || 0}
              </span>
              <span className="px-4 py-2 text-sm font-medium text-pink-800 bg-pink-100 rounded-full">
                💬 Feedback: {school.feedback?.length || 0}
              </span>
              <span className="px-4 py-2 text-sm font-medium text-indigo-800 bg-indigo-100 rounded-full">
                🍽️ Distribusi: {school.meal_distributions?.length || 0}
              </span>
            </div>

            {/* Chart Filter */}
            <div className="flex justify-center mb-6">
              <div className="inline-flex p-1 border border-purple-200 rounded-full bg-white/60 backdrop-blur-sm">
                {[
                  { value: 'minggu', label: 'Mingguan' },
                  { value: 'bulan', label: 'Bulanan' },
                  { value: 'tahun', label: 'Tahunan' }
                ].map((option) => (
                  <button
                    key={option.value}
                    onClick={() => setChartFilter(option.value)}
                    className={`px-4 py-2 text-sm font-medium rounded-full transition-all duration-300 ${
                      chartFilter === option.value
                        ? 'bg-purple-600 text-white shadow-lg'
                        : 'text-purple-600 hover:bg-purple-50'
                    }`}
                  >
                    {option.label}
                  </button>
                ))}
              </div>
            </div>

            {/* Chart */}
            <div className="h-80">
              <SimpleChart data={getChartData()} labels={getChartData().labels} />
            </div>
          </div>
        </div>

        {/* Detail Sections */}
        <div className="grid gap-8 md:grid-cols-2">
          {/* Teachers Section */}
          <div className="overflow-hidden transition-all duration-500 border border-purple-100 shadow-lg bg-white/80 backdrop-blur-sm rounded-2xl hover:shadow-xl">
            <div className="p-6 bg-gradient-to-r from-purple-500 to-purple-600">
              <h2 className="text-xl font-bold text-white">👨‍🏫 Data Guru</h2>
            </div>
            <div className="p-6">
              <div className="space-y-3 overflow-y-auto max-h-64">
                {school.users?.filter(u => u.role === 'guru').map((guru, index) => (
                  <div key={index} className="flex items-center gap-3 p-3 transition-colors duration-300 rounded-lg bg-gray-50 hover:bg-purple-50">
                    <div className="flex items-center justify-center w-8 h-8 bg-purple-100 rounded-full">
                      <span className="text-sm font-semibold text-purple-600">{guru.name.charAt(0)}</span>
                    </div>
                    <div>
                      <p className="font-medium text-gray-900">{guru.name}</p>
                      <p className="text-sm text-gray-500">{guru.email}</p>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* Classes Section */}
          <div className="overflow-hidden transition-all duration-500 border border-purple-100 shadow-lg bg-white/80 backdrop-blur-sm rounded-2xl hover:shadow-xl">
            <div className="p-6 bg-gradient-to-r from-blue-500 to-blue-600">
              <h2 className="text-xl font-bold text-white">🏫 Data Kelas</h2>
            </div>
            <div className="p-6">
              <div className="grid grid-cols-2 gap-3">
                {school.classes?.map((kelas, index) => (
                  <div key={index} className="p-3 text-center transition-colors duration-300 rounded-lg bg-gray-50 hover:bg-blue-50">
                    <p className="font-medium text-gray-900">{kelas.class_name}</p>
                  </div>
                ))}
              </div>
            </div>
          </div>

          {/* Students Section */}
          <div className="overflow-hidden transition-all duration-500 border border-purple-100 shadow-lg bg-white/80 backdrop-blur-sm rounded-2xl hover:shadow-xl">
            <div className="p-6 bg-gradient-to-r from-green-500 to-green-600">
              <h2 className="text-xl font-bold text-white">👨‍🎓 Data Siswa</h2>
            </div>
            <div className="p-6">
              <div className="space-y-2 overflow-y-auto max-h-64">
                {school.students?.slice(0, 20).map((siswa, index) => (
                  <div key={index} className="flex items-center gap-3 p-2 transition-colors duration-300 rounded-lg hover:bg-green-50">
                    <span className="text-sm text-gray-500">{index + 1}.</span>
                    <p className="text-sm font-medium text-gray-900">{siswa.name}</p>
                  </div>
                ))}
                {school.students?.length > 20 && (
                  <p className="text-sm text-center text-gray-500">
                    ... dan {school.students.length - 20} siswa lainnya
                  </p>
                )}
              </div>
            </div>
          </div>

          {/* Feedback Section */}
          <div className="overflow-hidden transition-all duration-500 border border-purple-100 shadow-lg bg-white/80 backdrop-blur-sm rounded-2xl hover:shadow-xl">
            <div className="p-6 bg-gradient-to-r from-pink-500 to-pink-600">
              <h2 className="text-xl font-bold text-white">💬 Feedback</h2>
            </div>
            <div className="p-6">
              <div className="space-y-4 overflow-y-auto max-h-64">
                {school.feedback?.map((fb, index) => (
                  <div key={index} className="p-4 transition-colors duration-300 rounded-lg bg-gray-50 hover:bg-pink-50">
                    <p className="text-sm text-gray-700">{fb.content}</p>
                    <div className="flex items-center gap-2 mt-2">
                      <div className="flex text-yellow-400">
                        {[...Array(5)].map((_, i) => (
                          <svg key={i} className="w-4 h-4 fill-current" viewBox="0 0 20 20">
                            <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                          </svg>
                        ))}
                      </div>
                    </div>
                  </div>
                ))}
              </div>
            </div>
          </div>
        </div>

        {/* Decorative Elements */}
        <div className="absolute w-20 h-20 bg-purple-200 rounded-full pointer-events-none top-20 left-10 opacity-60 animate-pulse"></div>
        <div className="absolute w-16 h-16 bg-pink-200 rounded-full opacity-50 pointer-events-none bottom-32 right-16 animate-bounce"></div>
        <div className="absolute w-12 h-12 bg-indigo-200 rounded-full pointer-events-none top-1/2 right-8 opacity-40 animate-pulse"></div>
      </div>
    </div>
  );
}