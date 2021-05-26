module.exports = [
    {
        path: '/',
        name: 'Home',
        component: () => import('@/pages/home/Home')
    },
    {
        path: '/profile/:id',
        name: 'Profile',
        component: () => import('@/pages/profile/Profile')
    },
    {
        path: '/search',
        name: 'Search',
        component: () => import('@/pages/search/Search')
    },
    {
        path: '/dataprivacy',
        name: 'Dataprivacy',
        component: () => import('@/pages/dataprivacy/Dataprivacy')
    },
    {
        path: '/settings',
        name: 'Settings',
        component: () => import('@/pages/settings/Settings')
    },
];