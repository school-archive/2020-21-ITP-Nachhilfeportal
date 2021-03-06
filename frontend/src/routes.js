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
        props: true,
        component: () => import('@/pages/search/Search')
    },
    {
        path: '/imprint',
        name: 'Imprint',
        component: () => import('@/pages/imprint/Imprint')
    },
    {
        path: '/privacy',
        name: 'Privacy',
        component: () => import('@/pages/dataprivacy/Dataprivacy')
    },
    {
        path: '/settings',
        name: 'Settings',
        component: () => import('@/pages/settings/Settings')
    },
    {
        path: '/aboutus',
        name: 'Aboutus',
        component: () => import('@/pages/aboutus/Aboutus')
    },
];