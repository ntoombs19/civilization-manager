export type CivilizationData = {
    id: number;
    name: string;
    icon: string;
    dawnOfMan: string;
    uniqueBuildings: Array<{ url: string; name: string }>;
    uniqueUnits: Array<{ url: string; name: string }>;
    cityNames: Array<string>;
    spyNames: Array<string>;
    historicalInfo: Array<{ title: string; content: string }>;
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
    trait: { name: string; effect: string };
    titles: Array<string>;
    historicalInfo: Array<{ text: string; heading: string }>;
};
