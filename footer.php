        </main>
    </div>

    <footer>
        Kasir Web
    </footer>

    <script>
        // Library SweetAlert2 digunakan untuk notifikasi hasil proses aplikasi.
        const params = new URLSearchParams(window.location.search);
        const pesan = params.get("pesan");

        if (pesan) {
            const isError = /gagal|error|tidak mencukupi|salah/i.test(pesan);

            Swal.fire({
                icon: isError ? "error" : "success",
                title: isError ? "Proses gagal" : "Berhasil",
                text: pesan,
                confirmButtonText: "OK"
            });
        }
    </script>

</body>

</html>