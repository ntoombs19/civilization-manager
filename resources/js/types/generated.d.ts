export type CivilizationData = {
    id: number;
    name: string;
    icon: string;
    dawnOfMan: string;
    uniqueBuildings: Array<{ url: string; name: string }>;
    uniqueUnits: Array<{ url: string; name: string }>;
    cityNames: Array<string>;
    spyNames: Array<string>;
    historicalInfo: Array<{ text: string; heading: string }>;
    url: string;
    leader: LeaderData | null;
};
export type LeaderData = {
    id: number;
    civilizationId: number;
    name: string;
    subtitle: string;
    lived: string;
    icon: string;
    trait: { name: string; effect: string };
    titles: Array<string>;
    historicalInfo: Array<{ text: string; heading: string }>;
    civilization: CivilizationData | null;
};
