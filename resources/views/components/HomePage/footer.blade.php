<footer class="mt-20 border-t">
    <div class="container xl:max-w-screen-2xl mx-auto px-4 py-20">
      <div
        class="grid grid-cols-2 md:flex justify-between items-stretch gap-8"
      >
        <div class="col-span-2 sm:col-span-1">
          <div class="flex justify-start items-end gap-3">
            <img src="{{ asset('new-images/LOGO.png') }}" alt="site-logo" />
            <h1 class="text-4xl font-semibold">BleepPilot</h1>
          </div>
          <div class="my-10">
            <label for="review" class="text-black font-semibold">
              Choose Country
            </label>
            <div class="relative">
              <select
                id="review"
                class="peer w-full rounded-md border border-black bg-transparent px-3 py-2.5 font-sans text-sm font-normal text-blue-gray-700 outline outline-0 transition-all placeholder-shown:border placeholder-shown:border-black placeholder-shown:border-t-blaborder-black empty:!bg-gray-900 focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50 focus:border-[#0BA1E5] mt-2 h-[46px]"
              >
                <option value="brazil" selected="">United States</option>
                <option value="bucharest">United Kingdom</option>
              </select>
            </div>
          </div>
          <div>
            <h1 class="font-semibold">Follow Us</h1>
            <div class="flex justify-start items-center gap-3 mt-3">
              <div>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                  fill="none"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M16 0C7.164 0 0 7.164 0 16C0 24.836 7.164 32 16 32C24.836 32 32 24.836 32 16C32 7.164 24.836 0 16 0ZM16 2.66699C23.352 2.66699 29.3334 8.64832 29.3334 16.0003C29.3334 23.3523 23.352 29.3337 16 29.3337C8.64802 29.3337 2.66669 23.3523 2.66669 16.0003C2.66669 8.64832 8.64802 2.66699 16 2.66699ZM10.6667 13.3333H13.3334V11.0773C13.3334 9.056 14.3974 8 16.7947 8H20V11.3333H18.0774C17.4614 11.3333 17.3334 11.5853 17.3334 12.2227V13.3333H20L19.76 16H17.3334V24H13.3334V16H10.6667V13.3333Z"
                    fill="black"
                  />
                </svg>
              </div>
              <div>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                  fill="none"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M16 0C7.164 0 0 7.164 0 16C0 24.836 7.164 32 16 32C24.836 32 32 24.836 32 16C32 7.164 24.836 0 16 0ZM16 2.66699C23.352 2.66699 29.3334 8.64832 29.3334 16.0003C29.3334 23.3523 23.352 29.3337 16 29.3337C8.64802 29.3337 2.66669 23.3523 2.66669 16.0003C2.66669 8.64832 8.64802 2.66699 16 2.66699ZM22.7814 12.2214C23.4454 12.1414 24.0787 11.9654 24.6667 11.7041C24.2267 12.3627 23.6707 12.9414 23.028 13.4027C23.236 18.0201 19.7934 23.1681 13.6974 23.1681C11.844 23.1681 10.12 22.6254 8.66669 21.6934C10.4094 21.8987 12.1467 21.4147 13.5294 20.3321C12.0947 20.3054 10.88 19.3574 10.4627 18.0534C10.9774 18.1521 11.484 18.1227 11.9454 17.9974C10.3667 17.6801 9.27602 16.2574 9.31202 14.7374C9.75469 14.9827 10.26 15.1307 10.7974 15.1481C9.33602 14.1707 8.92135 12.2401 9.78135 10.7654C11.4 12.7507 13.82 14.0574 16.5467 14.1947C16.068 12.1414 17.6254 10.1641 19.7454 10.1641C20.688 10.1641 21.5427 10.5627 22.14 11.2014C22.888 11.0547 23.5907 10.7814 24.2254 10.4054C23.9787 11.1721 23.46 11.8147 22.7814 12.2214Z"
                    fill="black"
                  />
                </svg>
              </div>
              <div>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  width="32"
                  height="32"
                  viewBox="0 0 32 32"
                  fill="none"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M16 0C7.164 0 0 7.164 0 16C0 24.836 7.164 32 16 32C24.836 32 32 24.836 32 16C32 7.164 24.836 0 16 0ZM16 2.66699C23.352 2.66699 29.3334 8.64832 29.3334 16.0003C29.3334 23.3523 23.352 29.3337 16 29.3337C8.64802 29.3337 2.66669 23.3523 2.66669 16.0003C2.66669 8.64832 8.64802 2.66699 16 2.66699ZM19.2333 9.48905C18.3893 9.45038 18.136 9.44238 16 9.44238C13.864 9.44238 13.6107 9.44905 12.768 9.48772C10.5973 9.58638 9.58668 10.6144 9.48801 12.7677C9.45068 13.6104 9.44135 13.8637 9.44135 15.9997C9.44135 18.1357 9.45068 18.389 9.48801 19.2317C9.58801 21.3797 10.5947 22.4117 12.768 22.5117C13.6107 22.5504 13.864 22.5584 16 22.5584C18.1373 22.5584 18.3893 22.549 19.2333 22.5117C21.404 22.413 22.4133 21.3824 22.5133 19.2317C22.5507 18.389 22.5587 18.1357 22.5587 15.9997C22.5587 13.8637 22.5507 13.6117 22.5133 12.7677C22.4133 10.6157 21.4027 9.58772 19.2333 9.48905ZM16 8C13.8267 8 13.556 8.00933 12.7013 8.04933C9.79467 8.18267 8.18133 9.79467 8.048 12.7013C8.00933 13.556 8 13.828 8 16C8 18.1733 8.00933 18.4453 8.048 19.2987C8.18133 22.204 9.79467 23.8187 12.7013 23.952C13.556 23.9907 13.8267 24 16 24C18.1733 24 18.4453 23.9907 19.3 23.952C22.2013 23.8187 23.8213 22.2067 23.952 19.2987C23.9907 18.4453 24 18.1733 24 16C24 13.828 23.9907 13.556 23.952 12.7013C23.8213 9.79867 22.2067 8.18133 19.3 8.04933C18.4453 8.00933 18.1733 8 16 8ZM11.892 15.9996C11.892 13.7303 13.732 11.8916 16 11.8916C18.268 11.8916 20.108 13.7316 20.108 15.9996C20.108 18.2689 18.268 20.1076 16 20.1076C13.732 20.1076 11.892 18.2689 11.892 15.9996ZM16 18.6663C14.5266 18.6663 13.3333 17.473 13.3333 15.9997C13.3333 14.5277 14.5266 13.333 16 13.333C17.472 13.333 18.668 14.5263 18.668 15.9997C18.668 17.473 17.472 18.6663 16 18.6663ZM19.3093 11.7305C19.3093 11.1998 19.74 10.7705 20.2693 10.7705C20.8013 10.7705 21.2307 11.1998 21.2307 11.7305C21.2307 12.2612 20.8 12.6905 20.2693 12.6905C19.7387 12.6905 19.3093 12.2598 19.3093 11.7305Z"
                    fill="black"
                  />
                </svg>
              </div>
            </div>
          </div>
        </div>
        <div class="md:h-full">
          <h1 class="text-xl font-medium">About</h1>
          <ul
            class="mt-10 space-y-9 flex justify-between items-start flex-col md:h-full"
          >
            <li>
              <a href="" class="font-light"> About us </a>
            </li>
            <li>
              <a href="" class="font-light"> Contact</a>
            </li>
            <li>
              <a href="" class="font-light"> Jobs </a>
            </li>
            <li>
              <a href="" class="font-light"> Blogs</a>
            </li>
            <li>
              <a href="" class="font-light"> Press</a>
            </li>
          </ul>
        </div>
        <div class="md:h-full">
          <h1 class="text-xl font-medium">Community</h1>
          <ul
            class="mt-10 space-y-9 flex justify-between items-start flex-col md:h-full"
          >
            <li>
              <a href="" class="font-light"> Log In </a>
            </li>
            <li>
              <a href="" class="font-light"> Sign Up</a>
            </li>
            <li>
              <a href="" class="font-light"> Jobs </a>
            </li>
            <li>
              <a href="" class="font-light"> Blogs</a>
            </li>
            <li>
              <a href="" class="font-light"> Press</a>
            </li>
          </ul>
        </div>
        <div class="md:h-full">
          <h1 class="text-xl font-medium">Businesses</h1>
          <ul
            class="mt-10 space-y-9 flex justify-between items-start flex-col md:h-full"
          >
            <li>
              <a href="" class="font-light">Businesses</a>
            </li>
            <li>
              <a href="" class="font-light"> Product</a>
            </li>
            <li>
              <a href="" class="font-light"> Logins </a>
            </li>
            <li>
              <a href="" class="font-light"> Blogs</a>
            </li>
            <li>
              <a href="" class="font-light"> Press</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </footer>
