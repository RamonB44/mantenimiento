<nav x-data="{ open:false }" class="bg-gray-800">
    <div class="px-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
          <!-- Mobile menu button-->
          <button x-on:click="open = !open" type="button" class="inline-flex items-center justify-center p-2 text-gray-400 rounded-md hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">

            <svg class="block w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg class="hidden w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="flex items-center justify-center flex-1 sm:items-stretch sm:justify-start">
          <a href="/" class="flex items-center flex-shrink-0">
            <img class="block w-auto h-8 lg:hidden" src="/img/logo.png" alt="Logo">
            <img class="hidden w-auto h-8 lg:block" src="/img/logo.png" alt="Logo">
          </a>
          <div class="hidden sm:block sm:ml-6">
            <div class="flex space-x-4">

              @role('jefe')
              <a href="{{ route('jefe.dashboard') }}" class="{{ request()->routeIs('jefe.dashboard') ?  'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Importar datos</a>
              @endrole

              @role('supervisor')
              <a href="{{ route('supervisor.programacion-de-tractores') }}" class="{{ request()->routeIs('supervisor.programacion-de-tractores') ?  'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Programación de Tractores</a>
              <a href="{{ route('supervisor.validar-rutinarios') }}" class="{{ request()->routeIs('supervisor.validar-rutinarios') ?  'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium" aria-current="page">Validar Rutinarios</a>
              @endrole

              @role('asistente')
              <a href="{{ route('asistente.reporte-de-tractores') }}" class="{{ request()->routeIs('asistente.reporte-de-tractores') ?  'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Reporte de tractores</a>
              @endrole

              @role('operador')
              <a href="{{ route('operador.solicitar-articulos') }}" class="{{ request()->routeIs('operator.solicitar-articulos') ?  'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Solicitar Artículos</a>
              @endrole

              @role('planificador')
              <a href="{{ route('planificador.validar-solicitud-de-articulos') }}" class="{{ request()->routeIs('planificador.validar-solicitud-de-articulos') ?  'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Validar Solicitud de Artículos</a>
              <a href="{{ route('planificador.importar-datos') }}" class="{{ request()->routeIs('planificador.importar-datos') ?  'bg-gray-900 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} px-3 py-2 rounded-md text-sm font-medium">Importar Datos</a>
              @endrole
            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
          <button type="button" class="p-1 text-gray-400 bg-gray-800 rounded-full hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
          </button>

          <!-- Profile dropdown -->
          <div x-data="{ open:false }" x-on:click="open = !open" class="relative ml-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <img class="object-cover w-8 h-8 rounded-full" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
              </button>
            </div>

            <!--
              Dropdown menu, show/hide based on menu state.

            -->
            <div x-show="open" class="absolute right-0 w-48 py-1 mt-2 origin-top-right bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
              <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-0">Tu perfil</a>
              <form method="POST" action="{{ route('logout') }}" x-data>
                  @csrf
                  <a href="#" href="{{ route('logout') }}" @click.prevent="$root.submit();" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1" id="user-menu-item-2">
                      Cerrar Sesión
                  </a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" x-show="open">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
        @role('jefe')
        <a href="{{ route('jefe.dashboard') }}" class="{{ request()->routeIs('jefe.dashboard') ? 'bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"' : 'text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium'}}">Dashboard</a>
        @endrole

        @role('supervisor')
        <a href="{{ route('supervisor.programacion-de-tractores') }}" class="{{ request()->routeIs('supervisor.programacion-de-tractores') ? 'bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"' : 'text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium'}}">Programación de Tractores</a>
        @endrole

        @role('operador')
        <a href="{{ route('operador.solicitar-articulos') }}" class="{{ request()->routeIs('operador.solicitar-articulos') ? 'bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"' : 'text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium'}}">Solicitar Articulos</a>
        @endrole

        @role('asistente')
        <a href="{{ route('asistente.reporte-de-tractores') }}" class="{{ request()->routeIs('asistente.reporte-de-tractores') ? 'bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"' : 'text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium'}}">Reporte de Tractores</a>
        @endrole

        @role('planificador')
        <a href="{{ route('planificador.validar-solicitud-de-articulos') }}" class="{{ request()->routeIs('planificador.validar-solicitud-de-articulos') ? 'bg-gray-900 text-white block px-3 py-2 rounded-md text-base font-medium" aria-current="page"' : 'text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium'}}">Validar Pedidos</a>
        @endrole
      </div>
    </div>
  </nav>
