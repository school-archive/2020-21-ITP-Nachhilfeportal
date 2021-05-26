module.exports = [
    {
        path: '/',
        name: 'Home',
        component: () => import('@/pages/home/Home')
    },
    {
        path: '/profile',
        name: 'Profile',
        component: () => import('@/pages/profile/Profile')
    },
    {
        path: '/search',
        name: 'Search',
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
];