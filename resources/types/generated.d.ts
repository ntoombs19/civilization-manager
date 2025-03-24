export type CivilizationData = {
    id: number;
    name: string;
    icon: string;
    dawnOfMan: string;
    uniqueBuildings: Array<any>;
    uniqueUnits: Array<any>;
    cityNames: Array<any>;
    spyNames: Array<any>;
    historicalInfo: Array<any>;
    url: string;
    leader: LeaderData;
};
export type LeaderData = {
    id: any | number;
    civilizationId: any | number;
    name: string;
    subtitle: string;
    lived: string;
    icon: string;
    trait: Array<any>;
    titles: Array<any>;
    historicalInfo: Array<any>;
};
