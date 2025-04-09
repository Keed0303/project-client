<script>
    function toggleSidebar() {
      document.getElementById('sidebar').classList.toggle('show');
      document.getElementById('sidebarOverlay').classList.toggle('show');
    }

    function setActive(element) {
      // Remove active class from all links
      document.querySelectorAll('.sidebar a').forEach(link => link.classList.remove('active'));
      // Add active class to the clicked link
      element.classList.add('active');
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>