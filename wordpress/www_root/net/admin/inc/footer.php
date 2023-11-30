                  <?php $domain =   $_SERVER['HTTP_HOST']; ?>
                  <footer class="my-8 mx-4 shadow">
                      <div class="flex flex-wrap">
                          <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                              <!--Data Card-->
                              <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                                  <div class="flex flex-row items-center">

                                      <h1 class="font-bold text-gray-400"><i class="fas fa-globe"></i>&nbsp; Domain: </h1>
                                      <h1 class="font-bold text-gray-600">&nbsp; <?php echo $domain; ?> </h1>
                                  </div>
                              </div>
                              <!--/Data Card-->
                          </div>
                          <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                              <!--Data Card-->
                              <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                                  <div class="flex flex-row items-center">
                                      <h1 class="font-bold text-gray-400"><i class="fas fa-exclamation-circle"></i>&nbsp; Scampage Status: </h1>
                                      <h1 class="font-bold text-gray-600">&nbsp; [ <i class="fas fa-caret-up text-green-500"></i> ] Active </h1>
                                  </div>
                              </div>
                              <!--/Data Card-->
                          </div>
                          <div class="w-full md:w-1/2 xl:w-1/3 p-3">
                              <!--Data Card-->
                              <div class="bg-gray-900 border border-gray-800 rounded shadow p-2">
                                  <div class="flex flex-row items-center">
                                      <h1 class="font-bold text-gray-400"><i class="fas fa-university"></i>&nbsp; Host: </h1>
                                      <h1 class="font-bold text-gray-600">&nbsp; <?php
                                                                                    $host = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
                                                                                    echo $host;
                                                                                    ?> </h1>
                                  </div>
                              </div>
                              <!--/Data Card-->
                  </footer>
                  
                  </div>
                  <div class="container  mx-auto flex py-2">
                      <a class="foot" href="https://t.me/codex_dz">
                          © c0dex_DZ
                      </a>
                  </div>
                  </div>