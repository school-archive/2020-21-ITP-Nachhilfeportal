module.exports = [
    {
        path: '/',
        component: () => import('@/pages/home/Home')
    },
    {
        path: '/profile',
        component: () => import('@/pages/profile/Profile')
    },
    {
        path: '/imprint',
        component: () => import('@/pages/imprint/Imprint')
    },
    {
        path: '/privacy',
        component: () => import('@/pages/dataprivacy/Dataprivacy')
    },
];