     
      <footer class="footer">
        <div class="container-fluid">
            <div class="d-flex justify-content-between flex-wrap gap-4">
                <div class="">
                    <span>Taufiqul Hakim &copy; 2025</span>
                </div>
                <div>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="" style="color: #374151;">Contact</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://github.com/taufiqlhm2u" target="__blank" style="color: #374151;">Github</a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://www.instagram.com/taufiqlh_?igsh=MTY1MnVkd3dxb3A0Mw==" target="__blank" style="color: #374151;">Instagram</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
      </footer>
     </div> <!--  akhir main  -->
   </div> <!--  akhir wrapper  -->
<script src="<?= BASEURL . 'js/script.js'?>"></script>
<?php if (isset($data['update'])) : ?>
    <script src="<?= BASEURL . 'js/' . $data['update'] ?>"></script>
<?php endif; ?> 
<script src="<?= BASEURL . 'js/search.js'?>"></script>
</body>
</html>