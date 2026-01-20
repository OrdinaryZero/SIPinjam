module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    // Tambahan: Pastikan ini mencakup sub-folder jika strukturmu berubah drastis
    "./saintek-app/resources/**/*.blade.php", 
    "./src/**/*.{html,js}", 
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}