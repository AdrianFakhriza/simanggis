import React from 'react';

export default function CTA() {
  return (
    <section className="relative py-20 text-center bg-blue-100"
    style={{
        background: 'linear-gradient(135deg, #f3e8ff 0%, #fdf2f8 50%, #e0e7ff 100%)'
      }}>
        
      <div className="max-w-4xl px-4 mx-auto">
        {/* Headline */}
        <h2 className="mb-4 text-3xl font-bold text-gray-800 md:text-4xl">
          Drive content marketing ROI
        </h2>

        {/* Description */}
        <p className="mb-12 text-lg text-gray-700 md:text-xl">
          Contently’s content marketing platform makes it easy to create high-performing content and measure its impact, down to the dollar. Our customers see:
        </p>

        {/* Statistics */}
        <div className="grid grid-cols-1 gap-8 mb-12 md:grid-cols-3">
          <div>
            <p className="text-3xl font-bold text-gray-800">$13.1M</p>
            <p className="mt-2 text-sm text-gray-600">avg. Content Value ROI generated per year by enterprise customers</p>
          </div>
          <div>
            <p className="text-3xl font-bold text-gray-800">6x</p>
            <p className="mt-2 text-sm text-gray-600">ROI on their Contently investment</p>
          </div>
          <div>
            <p className="text-3xl font-bold text-gray-800">40%</p>
            <p className="mt-2 text-sm text-gray-600">avg. audience growth in the first 6 months</p>
          </div>
        </div>

        {/* CTA Button */}
        <button className="px-6 py-3 font-semibold text-black transition duration-300 bg-yellow-400 rounded shadow-md hover:bg-yellow-300">
          READ CASE STUDY
        </button>
      </div>
    </section>
  );
}
