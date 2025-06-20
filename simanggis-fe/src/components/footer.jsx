import { Link } from "react-router-dom";

export default function Footer() {
  return (
    <footer className="bg-white dark:bg-gray-900 border-t-2 border-purple-200 dark:border-purple-800">
      <div className="mx-auto max-w-screen-xl px-4 py-10 sm:px-6 lg:px-8">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
          {/* Logo / Brand */}
          <div>
            <h2 className="text-2xl font-bold text-purple-700 dark:text-purple-400 mb-4">
              Simanggis
            </h2>
            <p className="text-gray-600 dark:text-gray-400">
              Sistem Monitoring Makanan Bergizi Gratis untuk Sekolah.
            </p>
          </div>

          {/* Links */}
          <div>
            <h3 className="text-lg font-semibold text-purple-700 dark:text-purple-400 mb-2">Menu</h3>
            <ul className="text-gray-600 dark:text-gray-400 space-y-2">
              <li>
                <Link
      to="/"
      className="hover:text-purple-800 dark:hover:text-purple-300 transition"
    >
      Home
    </Link>
  </li>
  <li>
    <Link
      to="/sekolah"
      className="hover:text-purple-800 dark:hover:text-purple-300 transition"
    >
      School
    </Link>
  </li>
  <li>
    <a
      href="https://wa.me/6285220682014"
      target="_blank"
      rel="noopener noreferrer"
      className="hover:text-purple-800 dark:hover:text-purple-300 transition"
    >
      Contact
    </a>
  </li>
  <li>
    <a
      href="/team"
      target="_blank"
      rel="noopener noreferrer"
      className="hover:text-purple-800 dark:hover:text-purple-300 transition"
    >
      Team
    </a>
  </li>
</ul>
          </div>

          {/* Social media */}
          <div>
            <h3 className="text-lg font-semibold text-purple-700 dark:text-purple-400 mb-2">
              Follow Us
            </h3>
            <div className="flex justify-center md:justify-start space-x-4">
              <a
                href="https://instagram.com/simanggis_for.school"
                className="text-purple-600 hover:text-purple-800 dark:hover:text-purple-300 transition"
              >
                <i className="fab fa-instagram text-xl" />
              </a>
              <a
                href="https://github.com/AdrianFakhriza/simanggis"
                target="_blank"
                rel="noopener noreferrer"
                className="text-purple-600 hover:text-purple-800 dark:hover:text-purple-300 transition"
              >
                <i className="fab fa-github text-xl" />
              </a>
            </div>
          </div>
        </div>

        {/* Copyright */}
        <div className="mt-10 border-t border-purple-200 dark:border-purple-800 pt-6 text-sm text-gray-500 dark:text-gray-400 text-center">
          © 2025{" "}
          <span className="font-semibold text-purple-600 dark:text-purple-400">
            Simanggis
          </span>
          . All rights reserved.
        </div>
      </div>
    </footer>
  );
}
